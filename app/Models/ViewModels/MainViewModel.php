<?php

namespace App\Models\ViewModels;

use App\Exceptions\WrongTimeException;
use App\Models\Interfaces\MeasurementRepositoryInterface;
use App\Models\TasksStatistics;

class MainViewModel
{
    private MeasurementRepositoryInterface $repository;

    public function __construct(MeasurementRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     * @throws WrongTimeException
     */
    public function data()
    {
        $data = [
            'url' => '',
            'measurements' => [],
            'statistics' => [],
        ];

        $data = $this->addMeasurements($data);
        $data=  $this->addStatistics($data);

        return $data;
    }

    /**
     * @param array $data
     * @return array
     * @throws WrongTimeException
     */
    private function addMeasurements(array $data): array
    {
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

    /**
     * @param array $data
     * @return array
     * @throws WrongTimeException
     */
    private function addStatistics(array $data): array
    {
        $statistics = new TasksStatistics($this->repository->latestMeasurements(0));

        $data['statistics'] = [
            'total_finished_tasks' => $statistics->totalFinishedTasks(),
            'total_queue_tasks' => $statistics->totalQueueTasks(),
            'average_time_per_task' => $statistics->averageTimePerTask()->format('%I:%S'),
            'expected_time_for_tasks' => $statistics->expectedTimeForTasks()->format('%H:%I:%S'),
        ];

        return $data;
    }
}
