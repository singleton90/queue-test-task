<?php

namespace App\Models\Interfaces;

use App\Models\Measurement;
use App\Models\MeasurementCollection;

interface MeasurementRepository
{
    /**
     * Сохраняет модель в базу
     *
     * @param Measurement $model
     * @return Measurement
     */
    public function save(Measurement $model): void;

    /**
     * Получает последние N замеров
     *
     * @param int $limit
     * @return MeasurementCollection
     */
    public function latestMeasurements(int $limit = 10): MeasurementCollection;
}
