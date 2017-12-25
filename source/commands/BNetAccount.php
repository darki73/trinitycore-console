<?php namespace FreedomCore\TrinityCore\Console\Commands;

use FreedomCore\TrinityCore\Console\Abstracts\BaseCommand;

/**
 * Class BNetAccount
 * @package FreedomCore\TrinityCore\Console\Commands
 */
class BNetAccount extends BaseCommand
{

    /**
     * Create new battle.net account
     * @param string $email
     * @param string $password
     * @return array|string
     */
    public function create(string $email, string $password)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Create game account for specified battle.net account
     * @param string $email
     * @return array|string
     */
    public function gameAccountCreate(string $email)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Link existing game account with battle.net account
     * @param string $email
     * @param string $login
     * @return array|string
     */
    public function link(string $email, string $login)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Unlink existing account from specified battle.net account
     * @param string $account
     * @param string $password
     * @return array|string
     */
    public function unlink(string $account, string $password)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * List game account on specified battle.net account
     * @param string $email
     * @return array|string
     */
    public function listGameAccounts(string $email)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Set new password for specified battle.net account
     * @param string $email
     * @param string $password
     * @param string $repeatPassword
     * @return array|string
     */
    public function setPassword(string $email, string $password, string $repeatPassword)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }
}
