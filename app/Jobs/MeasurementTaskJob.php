<?php

namespace App\Jobs;

use App\Models\Interfaces\MeasurementRepositoryInterface;
use App\Models\Interfaces\UrlInterface;
use App\Models\SqlMeasurementRepository;
use App\Models\VO\Url;
use App\Services\Interfaces\MeasurementServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class MeasurementTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var UrlInterface  */
    private UrlInterface $url;

    /** @var MeasurementServiceInterface  */
    private MeasurementServiceInterface $measurementService;

//    /** @var MeasurementRepositoryInterface  */
//    private MeasurementRepositoryInterface $repository;

    /**
     * Create a new job instance.
     *
     * @param UrlInterface $url
     * @param MeasurementServiceInterface $measurementService
     * @param MeasurementRepositoryInterface $repository
     */
    public function __construct(
        string $url
//        UrlInterface $url,
//        MeasurementServiceInterface $measurementService,
//        MeasurementRepositoryInterface $repository
    )
    {
        $this->url = new Url($url);
        $this->measurementService = new \App\Services\MeasurementService();
//        $this->url = $url;
//        $this->measurementService = $measurementService;
//        $this->repository = $repository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $measurement = $this->measurementService->createMeasurement($this->url);
        $repository = new SqlMeasurementRepository(DB::connection()->getPdo());
        $repository->save($measurement);
    }
}
