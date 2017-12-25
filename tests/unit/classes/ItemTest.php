<?php namespace FreedomCore\TrinityCore\Console\Tests\Unit\Classes;

use FreedomCore\TrinityCore\Console\Classes\Item;
use FreedomCore\TrinityCore\Console\Tests\BaseTest;

/**
 * Class ItemTest
 * @package FreedomCore\TrinityCore\Console\Tests\Unit\Classes
 */
class ItemTest extends BaseTest
{

    /**
     * Item ID used for test
     * @var int
     */
    protected $itemID = 49623;

    /**
     * Item Quantity used for test
     * @var int
     */
    protected $itemQuantity = 1;

    /**
     * Test that we are able to create items
     */
    public function testItemCreation()
    {
        $item = new Item($this->itemID, $this->itemQuantity);
        $this->assertEquals($this->itemID, $item->getID());
        $this->assertEquals($this->itemQuantity, $item->getQuantity());
    }

    /**
     * Test that we are able to create item with default quantity set to 1
     * @depends testItemCreation
     */
    public function testItemCreationWithDefaultQuantity()
    {
        $item = new Item($this->itemID);
        $this->assertEquals($this->itemID, $item->getID());
        $this->assertEquals($this->itemQuantity, $item->getQuantity());
    }

    /**
     * Test that conversion to array is working as expected
     * @depends testItemCreationWithDefaultQuantity
     */
    public function testItemToArray()
    {
        $item = new Item($this->itemID);
        $this->assertEquals(['id' => $this->itemID, 'count' => $this->itemQuantity], $item->toArray());
    }

    /**
     * Test that conversion to command attribute is working as expected
     * @depends testItemToArray
     */
    public function testItemToCommandAttribute()
    {
        $item = new Item($this->itemID);
        $this->assertEquals(sprintf('%s:%s', $this->itemID, $this->itemQuantity), $item->toCommandAttribute());
    }
}
