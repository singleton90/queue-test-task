<?php

namespace App\Models\Interfaces;

use DateInterval;
use DateTimeInterface;

/**
 * Interface MeasurementInterface
 * @package App\Models\Interfaces
 */
interface MeasurementInterface
{
    /**
     * @return DateTimeInterface
     */
    public function startTime(): DateTimeInterface;

    /**
     * @return DateInterval
     */
    public function executionTime(): DateInterval;

    /**
     * @return UrlInterface
     */
    public function url(): UrlInterface;

    /**
     * @return MeasurementParamsInterface
     */
    public function parameters(): MeasurementParamsInterface;
}
