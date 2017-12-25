<?php
use FreedomCore\TrinityCore\Console\Client;

$console = new Client('2#1', 'soapPassword');
$console->send()->mail('Playername', 'Mail Subject', 'Mail Body');