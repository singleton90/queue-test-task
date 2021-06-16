<?php

namespace App\Services\Interfaces;

use App\Models\Interfaces\MeasurementInterface;
use App\Models\Interfaces\UrlInterface;

/**
 * Интерфейс службы для произведения замеров по скорости открытия страницы
 *
 * @package App\Services\Interfaces
 */
interface MeasurementServiceInterface
{
    /**
     * Создает измерение для выбранного адреса
     *
     * @param UrlInterface $url
     * @return MeasurementInterface
     */
    public function createMeasurement(UrlInterface $url): MeasurementInterface;
}
