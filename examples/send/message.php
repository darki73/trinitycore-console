<?php
use FreedomCore\TrinityCore\Console\Client;

$console = new Client('2#1', 'soapPassword');
$console->send()->message('Playername', 'Message in the middle of the screen by administrator');