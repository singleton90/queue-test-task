<?php

namespace Tests\Unit;

use App\Exceptions\WrongTimeException;
use App\Models\Interfaces\MeasurementInterface;
use App\Models\Measurement;
use App\Models\VO\Url;
use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Models\Measurement
 * @package Tests\Unit
 */
class MeasurementTest extends TestCase
{
    const URL = 'https://google.com';

    /**
     * @return Measurement
     * @covers ::__construct
     */
    public function test_construct(): Measurement
    {
        $startTime = new DateTimeImmutable('2021-01-01 10:00:00');
        $url = new Url(self::URL);
        $measurement = new Measurement($startTime, $url);
        $this->assertInstanceOf(MeasurementInterface::class, $measurement);
        return $measurement;
    }

    /**
     * @param Measurement $measurement
     * @return Measurement
     * @depends test_construct
     * @covers ::setFinishTime
     */
    public function test_set_finish_time(Measurement $measurement): Measurement
    {
        $wrongFinishTime = new DateTimeImmutable('2021-01-01 09:00:00');
        $this->expectException(WrongTimeException::class);
        $measurement->setFinishTime($wrongFinishTime);
        return $measurement;
    }

    /**
     * @param Measurement $measurement
     * @depends test_construct
     * @covers ::startTime
     */
    public function test_start_time(Measurement $measurement)
    {
        $this->assertInstanceOf(DateTimeInterface::class, $measurement->startTime());
        $this->assertEquals('2021-01-01 10:00:00', $measurement->startTime()->format('Y-m-d H:i:s'));
    }

    /**
     * @param Measurement $measurement
     * @depends test_construct
     * @covers ::finishTime
     * @return Measurement
     * @throws WrongTimeException
     */
    public function test_finish_time(Measurement $measurement)
    {
        $finishTime = new DateTimeImmutable('2021-01-01 10:01:00');
        $measurement->setFinishTime($finishTime);
        $this->assertInstanceOf(DateTimeInterface::class, $measurement->finishTime());
        $this->assertEquals('2021-01-01 10:01:00', $measurement->finishTime()->format('Y-m-d H:i:s'));
        return $measurement;
    }

    /**
     * @param Measurement $measurement
     * @depends test_finish_time
     * @covers ::executionTime
     * @throws WrongTimeException
     */
    public function test_execution_time(Measurement $measurement)
    {
        $this->assertInstanceOf(DateTimeInterface::class, $measurement->executionTime());
        $this->assertEquals(60, $measurement->executionTime()->getTimestamp());
    }
}
