<?php

namespace App\Services;

use App\Exceptions\WrongTimeException;
use App\Models\Interfaces\MeasurementInterface;
use App\Models\Interfaces\UrlInterface;
use App\Models\Measurement;
use App\Models\VO\MeasurementParams;
use App\Services\Interfaces\MeasurementServiceInterface;
use DateTimeImmutable;
use Exception;

/**
 * Служба для произведения замеров по скорости открытия страницы
 *
 * @package App\Services
 */
class MeasurementService implements MeasurementServiceInterface
{
    /**
     * {@inheritdoc }
     *
     * @return MeasurementInterface
     * @throws WrongTimeException
     * @throws Exception
     */
    public function createMeasurement(UrlInterface $url): MeasurementInterface
    {
        $startTime = new DateTimeImmutable();
        $this->randomSleep();
        $params = MeasurementParams::fromCurlGetinfo($this->getCurlInfo($url));
        $finishTime = new DateTimeImmutable();

        $measurement = new Measurement($startTime, $url);
        $measurement->setFinishTime($finishTime);
        $measurement->setMeasurementParams($params);

        return $measurement;
    }

    /**
     * Получает информацию по CURL
     *
     * @param UrlInterface $url
     * @return array
     */
    public function getCurlInfo(UrlInterface $url): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url->urlString());
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        return $info;
    }

    /**
     * Приостанавливает скрипт на случайное кол-во секунд от 5 до 10
     *
     * @throws Exception
     */
    private function randomSleep(): void
    {
        sleep(random_int(5, 10));
    }
}
