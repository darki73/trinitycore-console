<?php

use FreedomCore\TrinityCore\Console\Client;

$console = new Client('2#1', 'soapPassword');
$server = $console->server();

/**
 * Convert minutes to seconds
 * @param int $minutes
 * @return int
 */
function minutesToSeconds(int $minutes) : int
{
    return $minutes * 60;
}

$restartInMinutes = 15;

$server->announce('Server will restart in ' . $restartInMinutes . ' minutes!');

$server->saveAll(); // If you run this script as a daemon,
// you can wrap in in a while() function to save players, for example
// 30 seconds before the server shutdown

$server->shutdown(minutesToSeconds($restartInMinutes), true);