<?php

namespace App\Models\ViewModels;

use App\Models\Interfaces\MeasurementRepository;
use App\Models\MeasurementCollection;

class MainViewModel
{
    private MeasurementRepository $repository;

    public function __construct(MeasurementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function data()
    {
        $data = [
            'url' => '',
            'measurements' => [],
        ];

        foreach ($this->repository->latestMeasurements() as $measurement) {
            $data['measurements'][] = [
                'url' => $measurement->url()->urlString(),
                'start_time' => $measurement->startTime()->format('Y-m-d H:i:s'),
                'execution_time' => $measurement->executionTime()->format('%I:%S'),
                'total_time' => $measurement->parameters()->totalTime(),
                'namelookup_time' => $measurement->parameters()->namelookupTime(),
                'connect_time' => $measurement->parameters()->connectTime(),
                'pretransfer_time' => $measurement->parameters()->pretransferTime(),
            ];
        }

        return $data;
    }
}
