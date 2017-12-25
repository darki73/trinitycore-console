<?php namespace FreedomCore\TrinityCore\Console\Classes;

/**
 * Class Item
 * @package FreedomCore\TrinityCore\Console\Classes
 */
class Item
{

    /**
     * Item ID
     * @var int|null
     */
    protected $id = null;

    /**
     * Item Count
     * @var int|null
     */
    protected $count = null;

    /**
     * Item constructor.
     * @param int $itemID
     * @param int $itemCount
     */
    public function __construct(int $itemID, int $itemCount = 1)
    {
        $this->id = $itemID;
        $this->count = $itemCount;
    }

    /**
     * Convert Class Object To Array
     * @return array
     */
    public function toArray() : array
    {
        return [
            $this->id,
            $this->count
        ];
    }

    /**
     * Convert Class Object To TrinityCore Command Attribute
     * @return string
     */
    public function toCommandAttribute() : string
    {
        return implode(':', $this->toArray());
    }
}
