<?php namespace FreedomCore\TrinityCore\Console\Commands;

use FreedomCore\TrinityCore\Console\Abstracts\BaseCommand;

/**
 * Class Guild
 * @package FreedomCore\TrinityCore\Console\Commands
 */
class Guild extends BaseCommand
{

    /**
     * Create new guild
     * Player MUST be online
     * @param string $leaderName
     * @param string $guildName
     * @return array|string
     */
    public function create(string $leaderName, string $guildName)
    {
        return $this->executeCommand(__FUNCTION__, [
            'leaderName'    =>  $leaderName,
            'guildName'     =>  $this->inQuotes($guildName)
        ]);
    }

    /**
     * Delete specified guild
     * @param string $guildName
     * @return array|string
     */
    public function delete(string $guildName)
    {
        return $this->executeCommand(__FUNCTION__, ['guildName'     =>  $this->inQuotes($guildName)]);
    }

    /**
     * Invite Specified Player To Specified Guild
     * @param string $playerName
     * @param string $guildName
     * @return array|string
     */
    public function invite(string $playerName, string $guildName)
    {
        return $this->executeCommand(__FUNCTION__, [
            'playerName'    =>  $playerName,
            'guildName'     =>  $this->inQuotes($guildName)
        ]);
    }

    /**
     * Rename Guild
     * @param string $oldName
     * @param string $newName
     * @return array|string
     */
    public function rename(string $oldName, string $newName)
    {
        return $this->executeCommand(__FUNCTION__, [
            'oldName'   =>  $this->inQuotes($oldName),
            'newName'   =>  $this->inQuotes($newName)
        ]);
    }

    /**
     * Get Information About Specified Guild
     * @param string $guildName
     * @return array|string
     */
    public function info(string $guildName)
    {
        return $this->executeCommand(__FUNCTION__, [
            'guildName' =>  $this->inQuotes($guildName)
        ]);
    }
}
