<?php namespace FreedomCore\TrinityCore\Console\Commands;

use FreedomCore\TrinityCore\Console\Abstracts\BaseCommand;

/**
 * Class Account
 * @package FreedomCore\TrinityCore\Console\Commands
 */
class Account extends BaseCommand {

    /**
     * Create new account
     * @param string $account
     * @param string $password
     * @return mixed
     */
    public function create(string $account, string $password) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Delete specified account
     * @param string $account
     * @return mixed
     */
    public function delete(string $account) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Set new password for the account
     * @param string $oldPassword
     * @param string $newPassword
     * @param string $repeatPassword
     * @return mixed
     */
    public function password(string $oldPassword, string $newPassword, string $repeatPassword) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Set expansion version for specified account
     * @param int $account
     * @param int $addon
     * @return mixed
     */
    public function setAddon(int $account, int $addon) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * @param string $account
     * @param int $level
     * @param int $realm
     * @return mixed
     */
    public function setGmLevel(string $account, int $level, int $realm = -1) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Sets the regmail for specified account
     * @param string $account
     * @param string $regMail
     * @param string $repeatRegMail
     * @return array|string
     */
    public function setSecRegmail(string $account, string $regMail, string $repeatRegMail) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Set the email for specified account
     * @param string $account
     * @param string $email
     * @param string $repeatEmail
     * @return array|string
     */
    public function setSecEmail(string $account, string $email, string $repeatEmail) {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Set password for account.
     * @param string $oldPassword
     * @param string $newPassword
     * @param string $repeatPassword
     * @return mixed
     */
    public function setPassword(string $oldPassword, string $newPassword, string $repeatPassword) {
        return $this->password($oldPassword, $newPassword, $repeatPassword);
    }

}