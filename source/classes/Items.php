<?php namespace FreedomCore\TrinityCore\Console\Classes;

/**
 * Class Items
 * @package FreedomCore\TrinityCore\Console\Classes
 */
class Items
{

    /**
     * Array of items
     * @var array
     */
    protected $items = [];

    /**
     * Items constructor.
     * @param array ...$items
     */
    public function __construct(...$items)
    {
        if (isset($items[0][0])) {
            $items = $items[0];
        }
        $this->items = $items;
    }

    /**
     * Get Items
     * @return array
     */
    public function getItems() : array
    {
        return $this->items;
    }

    /**
     * Count how many items we are created
     * @return int
     */
    public function count() : int
    {
        return count($this->items);
    }

    /**
     * Convert Class Object To Array
     * @return array
     */
    public function toArray() : array
    {
        $items = [];
        foreach ($this->items as $item) {
            /**
             * @var $item Item
             */
            $items[] = $item->toArray();
        }
        return $items;
    }

    /**
     * Convert Class Object To TrinityCore Command Attribute
     * @return string
     */
    public function toCommandAttribute() : string
    {
        $items = [];
        foreach ($this->items as $item) {
            $items[] = $item->toCommandAttribute();
        }
        return trim(implode(' ', $items));
    }
}
