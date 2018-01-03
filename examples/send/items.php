<?php

use FreedomCore\TrinityCore\Console\Client;
use FreedomCore\TrinityCore\Support\Classes\Items;
use FreedomCore\TrinityCore\Support\Classes\Item;

$itemsData = [
    49623   =>  1,
    29314   =>  1,
    21545   =>  5
];

$itemsArray = [];
foreach ($itemsData as $itemID => $count) {
    $item = new Item();
    $item->setItemID($itemID);
    $item->setCount($count);
    $itemsArray[] = $item;
}
$items = new Items($itemsArray);

$console = new Client('2#1', 'soapPassword');
$console->send()->items('Playername', 'Mail Subject', 'Mail Body', $items);
