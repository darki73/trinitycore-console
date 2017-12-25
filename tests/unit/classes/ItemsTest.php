<?php namespace FreedomCore\TrinityCore\Console\Tests\Unit\Classes;

use FreedomCore\TrinityCore\Console\Classes\Item;
use FreedomCore\TrinityCore\Console\Classes\Items;
use FreedomCore\TrinityCore\Console\Tests\BaseTest;

/**
 * Class ItemsTest
 * @package FreedomCore\TrinityCore\Console\Tests\Unit\Classes
 */
class ItemsTest extends BaseTest
{

    /**
     * Items Data For Tests
     * @var array
     */
    protected $itemsData = [
        ['id'   =>  49623, 'count' => 1],
        ['id'   =>  49624, 'count' => 3],
        ['id'   =>  49625, 'count' => 5],
        ['id'   =>  49626, 'count' => 10]
    ];

    /**
     * Test items creation
     */
    public function testItemsCreation()
    {
        $itemsObject = $this->createItemsObject();
        $items = new Items($itemsObject);
        $this->assertEquals(4, $items->count());
    }

    /**
     * Test that we are able to create Items object where Item has default value
     * @depends testItemsCreation
     */
    public function testItemsCreationDefault()
    {
        $itemsObject = $this->createItemsObject(true);
        $items = new Items($itemsObject);
        foreach ($items->getItems() as $index => $item) {
            /**
             * @var $item Item
             */
            $this->assertEquals($this->itemsData[$index]['id'], $item->getID());
            $this->assertEquals(1, $item->getQuantity());
        }
    }

    /**
     * Test that we are able to convert Items object ot array
     * @depends testItemsCreationDefault
     */
    public function testItemsToArray()
    {
        $itemsObject = $this->createItemsObject();
        $items = new Items($itemsObject);
        foreach ($items->toArray() as $index => $item) {
            $this->assertEquals($this->itemsData[$index], $item);
        }
    }

    /**
     * Test that we are able to convert Items to command attribute
     * @depends testItemsToArray
     */
    public function testItemsToCommandAttribute()
    {
        $itemsObject = $this->createItemsObject();
        $items = new Items($itemsObject);
        $generatedCommandAttributes = [];
        foreach ($this->itemsData as $item) {
            $generatedCommandAttributes[] = implode(':', $item);
        }
        $this->assertEquals($items->toCommandAttribute(), implode(' ', $generatedCommandAttributes));
    }

    /**
     * Create simple items object
     * @param bool $useDefault
     * @return array
     */
    protected function createItemsObject(bool $useDefault = false)
    {
        $itemsObject = [];
        foreach ($this->itemsData as $index => $item) {
            $itemsObject[] = ($useDefault) ? new Item($item['id']) : new Item($item['id'], $item['count']);
        }
        return $itemsObject;
    }
}
