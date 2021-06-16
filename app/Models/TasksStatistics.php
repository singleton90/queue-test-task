<?php

namespace App\Models;

use App\Exceptions\WrongTimeException;
use App\Models\Interfaces\TasksStatisticsInterface;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use Exception;
use Illuminate\Queue\Queue;

/**
 * Class TasksStatistics
 * @package App\Models
 */
class TasksStatistics implements TasksStatisticsInterface
{
    private MeasurementCollection $collection;

    public function __construct(MeasurementCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * {@inheritdoc }
     */
    public function totalFinishedTasks(): int
    {
        return $this->collection->count();
    }

    /**
     * {@inheritdoc }
     */
    public function totalQueueTasks(): int
    {
        return 123;
    }

    /**
     * {@inheritdoc }
     * @throws WrongTimeException
     * @throws Exception
     */
    public function averageTimePerTask(): DateInterval
    {
        $offset = new DateTime('@0');

        foreach ($this->collection as $item) {
            $offset->add($item->executionTime());
        }

        $averageSeconds = round($offset->getTimestamp() / $this->collection->count());

        return new DateInterval('PT' . $averageSeconds . 'S');
    }

    /**
     * {@inheritdoc }
     * @throws WrongTimeException
     * @throws Exception
     */
    public function expectedTimeForTasks(): DateInterval
    {
        $reference = new DateTimeImmutable('@0');
        $endTime = $reference->add($this->averageTimePerTask());
        $time = ($endTime->getTimestamp() - $reference->getTimestamp()) * $this->totalQueueTasks();

        return new DateInterval('PT' . $time . 'S');
    }
}
