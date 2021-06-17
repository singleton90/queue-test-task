<?php

namespace App\Jobs;

use App\Models\Interfaces\MeasurementRepositoryInterface;
use App\Models\Interfaces\UrlInterface;
use App\Services\Interfaces\MeasurementServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class MeasurementTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var UrlInterface  */
    private UrlInterface $url;

    /**
     * Create a new job instance.
     *
     * @param UrlInterface $url
     */
    public function __construct(UrlInterface $url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @param MeasurementRepositoryInterface $repository
     * @param MeasurementServiceInterface $service
     * @return void
     */
    public function handle(MeasurementRepositoryInterface $repository, MeasurementServiceInterface $service)
    {
        $measurement = $service->createMeasurement($this->url);
        $repository->save($measurement);
    }
}
