<?php namespace FreedomCore\TrinityCore\Console\Commands;

use FreedomCore\TrinityCore\Console\Abstracts\BaseCommand;

/**
 * Class Player
 * @package FreedomCore\TrinityCore\Console\Commands
 */
class Character extends BaseCommand
{

    /**
     * @inheritdoc
     * @var array
     */
    protected $doNotPrefix = [
        'unstuck',
        'unmute',
        'unban',
        'mute',
        'kick',
        'ban'
    ];

    /**
     * Teleport specified player to specified location
     * @param string $playerName
     * @param string $location
     * @return array|string
     */
    public function unstuck(string $playerName, string $location = 'graveyard')
    {
        $availableLocations = ['inn', 'graveyard', 'startzone'];
        if (!in_array($location, $availableLocations)) {
            $location = $availableLocations[1];
        }
        return $this->executeCommand(__FUNCTION__, ['playerName' => $playerName, 'location' => $location]);
    }

    /**
     * Restore messaging functionality for specified character
     * @param string $playerName
     * @return array|string
     */
    public function unmute(string $playerName)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Unban character by name
     * @param string $playerName
     * @param string $function
     * @return array|string
     */
    public function unban(string $playerName, $function = 'character')
    {
        return $this->executeCommand(__FUNCTION__, ['function' => $function, 'playerName' => $playerName]);
    }

    /**
     * Ban specified character
     * @param string $playerName
     * @param string $function
     * @return array|string
     */
    public function ban(string $playerName, $function = 'character')
    {
        return $this->executeCommand(__FUNCTION__, ['function' => $function, 'playerName' => $playerName]);
    }

    /**
     * Disable characters messaging functionality
     * @param string $playerName
     * @param int $minutes
     * @param string $reason
     * @return array|string
     */
    public function mute(string $playerName, int $minutes, $reason = 'No reason given!')
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Kick player from game world
     * @param string $playerName
     * @param string $reason
     * @return array|string
     */
    public function kick(string $playerName, string $reason = 'No reason given!')
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Send "customise character" request on next login
     * @param string $playerName
     * @return array|string
     */
    public function customize(string $playerName)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Send "change faction" request on next login
     * @param string $playerName
     * @return array|string
     */
    public function changeFaction(string $playerName)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Send "change race" request on next login
     * @param string $playerName
     * @return array|string
     */
    public function changeRace(string $playerName)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Completely delete character
     * @param string $playerName
     * @return array|string
     */
    public function erase(string $playerName)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Increase/Decrease character level by the provided value
     * @param string $playerName
     * @param int $level
     * @return array|string
     */
    public function level(string $playerName, int $level = 1)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Send "change name" request on next login.
     * IF $newName is provided, name will be forcefully changed
     * @param string $oldName
     * @param string $newName
     * @return array|string
     */
    public function rename(string $oldName, string $newName = '')
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Show reputation information for selected character
     * Player MUST be online
     * @param string $playerName
     * @return array|string
     */
    public function reputation(string $playerName)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Show titles known by character
     * Player MUST be online
     * @param string $playerName
     * @return array|string
     */
    public function titles(string $playerName)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Delete characters which contain specified string in their name
     * @param string $playerName
     * @return array|string
     */
    public function deletedDelete(string $playerName = '')
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Show deleted characters with specified string in their names
     * @param string $playerName
     * @return array|string
     */
    public function deletedList(string $playerName = '')
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Restore deleted characters with specified string in their names
     * @param string $playerName
     * @return array|string
     */
    public function deletedRestore(string $playerName = '')
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Delete characters which was deleted more than $days ago
     * @param string $playerName
     * @param int $days
     * @return array|string
     */
    public function deletedOld(string $playerName, int $days)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }
}
