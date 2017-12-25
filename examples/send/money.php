<?php
use FreedomCore\TrinityCore\Console\Client;

function bronzeToGold(int $goldAmount) : int
{
    return $goldAmount * 100 * 100;
}

function bronzeToSilver(int $silverAmount) : int
{
    return $silverAmount * 100;
}

$console = new Client('2#1', 'soapPassword');
$console->send()->money('Playername', 'Mail Subject', 'Mail Body', bronzeToGold(50000));
