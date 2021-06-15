<?php

namespace App\Models\VO;

use App\Exceptions\WrongUrlException;
use App\Models\Interfaces\UrlInterface;

/**
 * Класс отвечает за проверку и передачу url-адреса
 *
 * @package App\Models\VO
 */
class Url implements UrlInterface
{
    /** @var string  */
    protected string $url;

    /**
     * Url constructor.
     *
     * @param string $url
     * @throws WrongUrlException
     */
    public function __construct(string $url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new WrongUrlException('Не верный формат url-адреса.');
        }

        $this->url = $url;
    }

    /**
     * {@inheritdoc }
     */
    public function urlString(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->url;
    }
}
