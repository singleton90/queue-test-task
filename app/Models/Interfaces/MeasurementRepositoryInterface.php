<?php

namespace App\Models\Interfaces;

use App\Models\MeasurementCollection;

/**
 * Интерфейс для взаимодействия с хранилищем
 *
 * @package App\Models\Interfaces
 */
interface MeasurementRepositoryInterface
{
    /**
     * Сохраняет модель в базу
     *
     * @param MeasurementInterface $model
     */
    public function save(MeasurementInterface $model): void;

    /**
     * Получает последние N замеров
     *
     * @param int $limit
     * @return MeasurementCollection
     */
    public function latestMeasurements(int $limit = 10): MeasurementCollection;
}
