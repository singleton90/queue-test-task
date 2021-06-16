<?php

namespace App\Models;

use App\Exceptions\WrongUrlException;
use App\Models\Interfaces\MeasurementInterface;
use App\Models\Interfaces\MeasurementRepositoryInterface;
use App\Models\VO\MeasurementParams;
use App\Models\VO\Url;
use DateTimeImmutable;
use Exception;
use PDO;
use PDOStatement;

/**
 * Class SqlMeasurementRepository
 * @package App\Models
 */
class SqlMeasurementRepository implements MeasurementRepositoryInterface
{
    const DIVIDER = 1000000;

    const DATE_FORMAT = 'Y-m-d H:i:s';

    private PDO $pdo;

    /**
     * SqlMeasurementRepository constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param MeasurementInterface $model
     */
    public function save(MeasurementInterface $model): void
    {
        $sql = 'INSERT INTO measurements (start_time, finish_time, url, total_time, namelookup_time, connect_time, pretransfer_time)
            VALUES (:start_time, :finish_time, :url, :total_time, :namelookup_time, :connect_time, :pretransfer_time)';

        $this->execute($sql, [
            ':start_time' => $model->startTime()->format(self::DATE_FORMAT),
            ':finish_time' => $model->finishTime()->format(self::DATE_FORMAT),
            ':url' => $model->url()->urlString(),
            ':total_time' => $model->parameters()->totalTime() * self::DIVIDER,
            ':namelookup_time' => $model->parameters()->namelookupTime() * self::DIVIDER,
            ':connect_time' => $model->parameters()->connectTime() * self::DIVIDER,
            ':pretransfer_time' => $model->parameters()->pretransferTime() * self::DIVIDER,
        ]);
    }

    /**
     * @param string $sql
     * @param array $parameters
     * @return bool|PDOStatement
     */
    private function execute(string $sql, array $parameters)
    {
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($parameters);

        return $stmt;
    }

    /**
     * @param array $row
     * @return Measurement
     * @throws WrongUrlException
     * @throws Exception
     */
    private function buildMeasurement(array $row): Measurement
    {
        $model = new Measurement(
            new DateTimeImmutable($row['start_time']),
            new Url($row['url'])
        );

        $model->setFinishTime(new DateTimeImmutable($row['finish_time']));

        $model->setMeasurementParams(new MeasurementParams(
            $row['total_time'] / self::DIVIDER,
            $row['namelookup_time'] / self::DIVIDER,
            $row['connect_time'] / self::DIVIDER,
            $row['pretransfer_time'] / self::DIVIDER
        ));

        return $model;
    }

    /**
     * @param int $limit
     * @return MeasurementCollection
     * @throws WrongUrlException
     * @throws Exception
     */
    public function latestMeasurements(int $limit = 10): MeasurementCollection
    {
        $sql = 'SELECT * FROM measurements ORDER BY start_time DESC';

        if ($limit > 0) {
            $sql .= ' LIMIT ' . $limit;
        }

        $stmt = $this->execute($sql, []);

        $measurements = array_map(fn(array $row) => $this->buildMeasurement($row), $stmt->fetchAll(PDO::FETCH_ASSOC));

        return new MeasurementCollection($measurements);
    }
}
