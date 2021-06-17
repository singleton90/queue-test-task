<?php

namespace App\Models\Interfaces;

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
     * @return DateTimeInterface
     */
    public function executionTime(): DateTimeInterface;

    /**
     * @return UrlInterface
     */
    public function url(): UrlInterface;

    /**
     * @return MeasurementParamsInterface
     */
    public function parameters(): MeasurementParamsInterface;
}
