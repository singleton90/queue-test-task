<?php

namespace Tests\Unit;

use App\Models\Interfaces\MeasurementInterface;
use App\Models\Interfaces\MeasurementParamsInterface;
use App\Models\VO\Url;
use App\Services\MeasurementService;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Services\MeasurementService
 * @package Tests\Unit
 */
class MeasurementServiceTest extends TestCase
{
    /**
     * @covers ::createMeasurement
     */
    public function test_create_measurement()
    {
        $service = new MeasurementService();
        $measurement = $service->createMeasurement(new Url('https://google.com'));
        $this->assertInstanceOf(MeasurementInterface::class, $measurement);
        $this->assertInstanceOf(MeasurementParamsInterface::class, $measurement->parameters());
    }
}
