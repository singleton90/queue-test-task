<?php

namespace App\Models;

use App\Exceptions\WrongTimeException;
use App\Models\Interfaces\MeasurementInterface;
use App\Models\Interfaces\MeasurementParamsInterface;
use App\Models\Interfaces\UrlInterface;
use DateTimeImmutable;
use DateTimeInterface;

/**
 * Class Measurement
 * @package App\Models
 */
final class Measurement implements MeasurementInterface
{
    /** @var DateTimeInterface Время начала выполнения задачи */
    private DateTimeInterface $startTime;

    /** @var DateTimeInterface Время окончания выполнения задачи */
    private DateTimeInterface $finishTime;

    /** @var UrlInterface Ссылка на страницу  */
    private UrlInterface $url;

    /** @var MeasurementParamsInterface Результаты измерений */
    private MeasurementParamsInterface $measurementParams;

    /**
     * Measurement constructor.
     *
     * @param DateTimeInterface $startTime
     * @param UrlInterface $url
     */
    public function __construct(DateTimeInterface $startTime, UrlInterface $url)
    {
        $this->startTime = $startTime;
        $this->url = $url;
    }

    /**
     * Устанавливает время завершения задачи
     *
     * @param DateTimeInterface $finishTime
     * @throws WrongTimeException
     */
    public function setFinishTime(DateTimeInterface $finishTime): void
    {
        if ($finishTime < $this->startTime) {
            throw new WrongTimeException('Время завершения не может быть меньше времени начала.');
        }

        $this->finishTime = $finishTime;
    }

    /**
     * @param MeasurementParamsInterface $measurementParams
     */
    public function setMeasurementParams(MeasurementParamsInterface $measurementParams)
    {
        $this->measurementParams = $measurementParams;
    }

    /**
     * @return DateTimeInterface
     */
    public function startTime(): DateTimeInterface
    {
        return $this->startTime;
    }

    /**
     * @return DateTimeInterface
     */
    public function finishTime(): DateTimeInterface
    {
        return $this->finishTime;
    }

    /**
     * @return DateTimeInterface
     * @throws WrongTimeException
     */
    public function executionTime(): DateTimeInterface
    {
        if (!isset($this->finishTime)) {
            throw new WrongTimeException('Время окончания задачи не установлено.');
        }

        $interval = $this->finishTime->getTimestamp() - $this->startTime->getTimestamp();

        return (new DateTimeImmutable())->setTimestamp($interval);
    }

    /**
     * @return UrlInterface
     */
    public function url(): UrlInterface
    {
        return $this->url;
    }

    /**
     * @return MeasurementParamsInterface
     */
    public function parameters(): MeasurementParamsInterface
    {
        return $this->measurementParams;
    }
}
