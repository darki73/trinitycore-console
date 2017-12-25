<?php

use FreedomCore\TrinityCore\Console\Client;
use FreedomCore\TrinityCore\Console\Classes\Items;
use FreedomCore\TrinityCore\Console\Classes\Item;

$items = new Items(
    new Item(49623),
    new Item(22589),
    new Item(19019, 1),
    new Item(71086, 2)
);

$console = new Client('2#1', 'soapPassword');
$console->send()->items('Playername', 'Mail Subject', 'Mail Body', $items);
