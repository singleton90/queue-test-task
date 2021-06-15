<?php

namespace App\Models;

use ArrayAccess;
use Countable;
use Exception;
use Iterator;

/**
 * Class MeasurementCollection
 * @package App\Models
 */
class MeasurementCollection implements Iterator, ArrayAccess, Countable
{
    /** @var Measurement[] */
    protected array $items = [];

    /** @var int */
    protected int $position = 0;

    /**
     * MeasurementCollection constructor.
     * @param array $items
     * @throws Exception
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->offsetSet('', $item);
        }
    }

    /**
     * {@inheritdoc }
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * {@inheritdoc }
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    /**
     * {@inheritdoc }
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * {@inheritdoc }
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * {@inheritdoc }
     */
    public function current()
    {
        return $this->items[$this->position];
    }

    /**
     * {@inheritdoc }
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * {@inheritdoc }
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc }
     */
    public function valid()
    {
        return isset($this->items[$this->position]);

    }

    /**
     * {@inheritdoc }
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * {@inheritdoc }
     * @throws Exception
     */
    public function offsetSet($offset, $item)
    {
        if (!($item instanceof Measurement)) {
            throw new Exception("Item must be an instance of App\Models\Measurement");
        }

        if (empty($offset)) {
            $this->items[] = $item;
        } else {
            $this->items[$offset] = $item;
        }
    }
}
