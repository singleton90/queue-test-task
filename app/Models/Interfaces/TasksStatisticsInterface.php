<?php

namespace App\Models\Interfaces;

use DateInterval;

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
     * @return DateInterval
     */
    public function averageTimePerTask(): DateInterval;

    /**
     * Рассчетное время выполнения оставшихся задач
     *
     * @return DateInterval
     */
    public function expectedTimeForTasks(): DateInterval;
}
