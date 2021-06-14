<?php

namespace App\Models\Interfaces;

/**
 * Interface MeasurementParamsInterface
 *
 * @package App\Models\Interfaces
 */
interface MeasurementParamsInterface
{
    /**
     * @return float
     */
    public function totalTime(): float;

    /**
     * @return float
     */
    public function namelookupTime(): float;

    /**
     * @return float
     */
    public function connectTime(): float;

    /**
     * @return float
     */
    public function pretransferTime(): float;
}
