<?php namespace FreedomCore\TrinityCore\Console;

use FreedomCore\TrinityCore\Console\Abstracts\BaseClient;
use FreedomCore\TrinityCore\Console\Commands\Account;
use FreedomCore\TrinityCore\Console\Commands\BNetAccount;
use FreedomCore\TrinityCore\Console\Commands\GM;
use FreedomCore\TrinityCore\Console\Commands\Guild;
use FreedomCore\TrinityCore\Console\Commands\LFG;
use FreedomCore\TrinityCore\Console\Commands\Character;
use FreedomCore\TrinityCore\Console\Commands\Reset;
use FreedomCore\TrinityCore\Console\Commands\Server;

/**
 * Class Client
 * @package FreedomCore\TrinityCore\Console
 */
class Client extends BaseClient
{

    /**
     * Client constructor.
     * @param string $username Username used to connect to the server
     * @param string $password Password used to connect to the server
     * @param boolean $createNow Should the connection be created as soon as possible
     * @throws \Exception
     */
    public function __construct(string $username, string $password, bool $createNow = true)
    {
        parent::__construct($username, $password, $createNow);
    }

    /**
     * Get Account Command Interface
     * @return Account
     */
    public function account() : Account
    {
        return (new Account($this->client));
    }

    /**
     * Get Bnet Command Interface
     * @return BNetAccount
     */
    public function bnet() : BNetAccount
    {
        return (new BNetAccount($this->client));
    }

    /**
     * Get Character Command Interface
     * @return Character
     */
    public function character() : Character
    {
        return (new Character($this->client));
    }

    /**
     * Get GM Command Interface
     * @return GM
     */
    public function gm() : GM
    {
        return (new GM($this->client));
    }

    /**
     * Get Guild Command Interface
     * @return Guild
     */
    public function guild() : Guild
    {
        return (new Guild($this->client));
    }

    /**
     * Get LFG Command Interface
     * @return LFG
     */
    public function lfg() : LFG
    {
        return (new LFG($this->client));
    }

    /**
     * Get Reset Command Instance
     * @return Reset
     */
    public function reset() : Reset
    {
        return (new Reset($this->client));
    }

    /**
     * Get Server Command Interface
     * @return Server
     */
    public function server() : Server
    {
        return (new Server($this->client));
    }
}
