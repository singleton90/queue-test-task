<?php

namespace App\Models\VO;

use App\Models\Interfaces\MeasurementParamsInterface;

/**
 * Класс с параметрами загрузки страницы по CURL
 *
 * @package App\Models
 */
final class MeasurementParams implements MeasurementParamsInterface
{
    /** @var float  */
    private float $totalTime;

    /** @var float  */
    private float $namelookupTime;

    /** @var float  */
    private float $connectTime;

    /** @var float  */
    private float $pretransferTime;

    /**
     * MeasurementParams constructor.
     *
     * @param float $totalTime
     * @param float $namelookupTime
     * @param float $connectTime
     * @param float $pretransferTime
     */
    public function __construct(float $totalTime, float $namelookupTime, float $connectTime, float $pretransferTime)
    {
        $this->totalTime = $totalTime;
        $this->namelookupTime = $namelookupTime;
        $this->connectTime = $connectTime;
        $this->pretransferTime = $pretransferTime;
    }

    /**
     * Возвращает экземпляр класса из массива, возвращаемого curl
     *
     * @param array $params
     * @return static
     */
    public static function fromCurlGetinfo(array $params): self
    {
        return new MeasurementParams(
            $params['total_time'],
            $params['namelookup_time'],
            $params['connect_time'],
            $params['pretransfer_time']
        );
    }

    /**
     * @return float
     */
    public function totalTime(): float
    {
        return $this->totalTime;
    }

    /**
     * @return float
     */
    public function namelookupTime(): float
    {
        return $this->namelookupTime;
    }

    /**
     * @return float
     */
    public function connectTime(): float
    {
        return $this->connectTime;
    }

    /**
     * @return float
     */
    public function pretransferTime(): float
    {
        return $this->pretransferTime;
    }
}
