<?php

namespace App\Models;

use App\Exceptions\WrongTimeException;
use App\Models\Interfaces\TasksStatisticsInterface;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use Illuminate\Support\Facades\Queue;

/**
 * Class TasksStatistics
 * @package App\Models
 */
class TasksStatistics implements TasksStatisticsInterface
{
    /** @var MeasurementCollection  */
    private MeasurementCollection $collection;

    public function __construct(MeasurementCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * {@inheritdoc }
     */
    public function totalFinishedTasks(): int
    {
        return $this->collection->count();
    }

    /**
     * {@inheritdoc }
     */
    public function totalQueueTasks(): int
    {
        return Queue::size();
    }

    /**
     * {@inheritdoc }
     *
     * @throws WrongTimeException
     * @throws Exception
     */
    public function averageTimePerTask(): DateTimeInterface
    {
        $total = 0;

        foreach ($this->collection as $item) {
            $total += $item->executionTime()->getTimestamp();
        }

        $averageSeconds = round($total / $this->collection->count());

        return (new DateTimeImmutable())->setTimestamp($averageSeconds);
    }

    /**
     * {@inheritdoc }
     *
     * @throws WrongTimeException
     * @throws Exception
     */
    public function expectedTimeForTasks(): DateTimeInterface
    {
        $time = $this->averageTimePerTask()->getTimestamp() * $this->totalQueueTasks();

        return (new DateTimeImmutable())->setTimestamp($time);
    }
}
