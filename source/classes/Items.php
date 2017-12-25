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
        $this->items = $items;
    }

    /**
     * Convert Class Object To Array
     * @return array
     */
    public function toArray() : array
    {
        $items = [];
        foreach ($this->items as $item) {
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
