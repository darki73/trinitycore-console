<?php

use FreedomCore\TrinityCore\Console\Client;

$console = new Client('2#1', 'soapPassword');
$reset = $console->reset();
$send = $console->send();

$player = (object) [
    'guid'  =>  1,
    'name'  =>  'PlayerName'
];

/**
 * Array of commands to be executed
 * @var array
 */
$callCommands = ['achievements', 'honor', 'level', 'spells', 'stats', 'talents'];
foreach ($callCommands as $command) {
    $reset->$command($player->name);
}
$send->mail($player->name, 'Character Reset', 'You have requested a character reset and now it is complete!');