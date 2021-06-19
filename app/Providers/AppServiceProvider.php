<?php

namespace App\Providers;

use App\Models\Interfaces\MeasurementInterface;
use App\Models\Interfaces\MeasurementParamsInterface;
use App\Models\Interfaces\MeasurementRepositoryInterface;
use App\Models\Interfaces\TasksStatisticsInterface;
use App\Models\Interfaces\UrlInterface;
use App\Models\Measurement;
use App\Models\SqlMeasurementRepository;
use App\Models\TasksStatistics;
use App\Models\VO\MeasurementParams;
use App\Models\VO\Url;
use App\Services\Interfaces\MeasurementServiceInterface;
use App\Services\MeasurementService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MeasurementRepositoryInterface::class, function() {
            return new SqlMeasurementRepository(DB::connection()->getPdo());
        });

        $this->app->bind(MeasurementServiceInterface::class, function () {
            return new MeasurementService();
        });

        $this->app->bind(MeasurementParamsInterface::class, MeasurementParams::class);

        $this->app->bind(MeasurementInterface::class, Measurement::class);

        $this->app->bind(UrlInterface::class, Url::class);

        $this->app->bind(TasksStatisticsInterface::class, TasksStatistics::class);
    }
}
