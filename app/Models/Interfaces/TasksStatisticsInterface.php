<?php

namespace App\Models\Interfaces;

use DateTimeInterface;

/**
 * Интерфейс для вывода статистики по задачам
 *
 * @package App\Models\Interfaces
 */
interface TasksStatisticsInterface
{
    /**
     * Кол-во обработанных задач
     *
     * @return int
     */
    public function totalFinishedTasks(): int;

    /**
     * Кол-во задач в очереди
     *
     * @return int
     */
    public function totalQueueTasks(): int;

    /**
     * Среднее время выполнения задачи
     *
     * @return DateTimeInterface
     */
    public function averageTimePerTask(): DateTimeInterface;

    /**
     * Рассчетное время выполнения оставшихся задач
     *
     * @return DateTimeInterface
     */
    public function expectedTimeForTasks(): DateTimeInterface;
}
