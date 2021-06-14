<?php

namespace App\Models\Interfaces;

/**
 * Interface UrlInterface
 * @package App\Models\Interfaces
 */
interface UrlInterface
{
    /**
     * Возвращает ссылку на страницу
     *
     * @return string
     */
    public function urlString(): string;
}
