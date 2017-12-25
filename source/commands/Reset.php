<?php namespace FreedomCore\TrinityCore\Console\Commands;

use FreedomCore\TrinityCore\Console\Abstracts\BaseCommand;

/**
 * Class Reset
 * @package FreedomCore\TrinityCore\Console\Commands
 */
class Reset extends BaseCommand {

    /**
     * Reset achievements for specified player
     * @param string $playerName
     * @return array|string
     */
    public function achievements(string $playerName) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Reset honor for specified player
     * @param string $playerName
     * @return array|string
     */
    public function honor(string $playerName) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Reset level for specified player
     * @param string $playerName
     * @return array|string
     */
    public function level(string $playerName) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Reset spells for specified player
     * @param string $playerName
     * @return array|string
     */
    public function spells(string $playerName) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Reset stats for specified player
     * @param string $playerName
     * @return array|string
     */
    public function stats(string $playerName) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Reset talents for specified player
     * @param string $playerName
     * @return array|string
     */
    public function talents(string $playerName) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Reset $type (talents/spells) for ALL players
     * @param string $type
     * @return array|string
     */
    public function all(string $type) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

}