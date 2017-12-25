<?php namespace FreedomCore\TrinityCore\Console\Commands;

use FreedomCore\TrinityCore\Console\Abstracts\BaseCommand;

/**
 * Class Server
 * @package FreedomCore\TrinityCore\Console\Commands
 */
class Server extends BaseCommand
{

    /**
     * @inheritdoc
     * @var array
     */
    protected $doNotPrefix = [
        'saveAll',
        'notify',
        'announce'
    ];

    /**
     * Trigger corpses expire check in world
     * @return array|string
     */
    public function corpses()
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Terminate server NOW
     * Exit code 0
     * @return array|string
     */
    public function exit()
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Display server version and the number of connected players
     * @return array|string
     */
    public function info()
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Show message of the day
     * @return array|string
     */
    public function motd()
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Without the argument passed, it will display current limit for players.
     * With argument greater that 0, it will set the new limit for max players.
     * `reset` parameter may be used to set the value from config.
     * @param string $parameter
     * @return array|string
     */
    public function plimit($parameter = '')
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Set Diff Time For Sever
     * @param int $diffTime
     * @return array|string
     */
    public function setDiffTime(int $diffTime)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Set Log Level For Server
     * @param string $facility
     * @param string $name
     * @param int $logLevel
     * @return array|string
     */
    public function setLogLevel(string $facility, string $name, int $logLevel)
    {
        $facilities = ['a', 'l'];
        $levels = range(0, 6);
        if (!in_array($facility, $facilities)) {
            throw new \RuntimeException('Invalid type of facility, possible values are: a (appender), l (logger)');
        }
        if (in_array($logLevel, $levels)) {
            throw new \RuntimeException('Log level is out of range, possible values are between 0 (disabled) and 6');
        }
        return $this->executeCommand(__FUNCTION__, [
            'facility'  =>  $facility,
            'name'      =>  $name,
            'logLevel'  =>  $logLevel
        ]);
    }

    /**
     * Set new message of the day
     * @param string $motd
     * @return array|string
     */
    public function setMotd(string $motd)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Sets whether the world accepts new client connections
     * @param bool $isClosed
     * @return array|string
     */
    public function setClosed(bool $isClosed)
    {
        $closed = ($isClosed) ? 'on' : 'off';
        return $this->executeCommand(__FUNCTION__, ['isClosed' => $closed]);
    }

    /**
     * Shutdown server
     * @param int $timer Timer for the sever shutdown
     * @param bool $force Should the shutdown be forced
     * @param int $code Exit code
     * @return array|string
     */
    public function shutdown(int $timer, bool $force = false, int $code = 0)
    {
        $force = ($force) ? 'force' : '';
        return $this->executeCommand(__FUNCTION__, [
            'force' =>  $force,
            'timer' =>  $timer,
            'code'  =>  $code
        ]);
    }

    /**
     * Cancel the restart/shutdown timer if any
     */
    public function shutdownCancel()
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Save all players.
     * @return array|string
     */
    public function saveAll()
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Display a message to all online players
     * @param string $message
     * @return array|string
     */
    public function notify(string $message)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }

    /**
     * Send announcement
     * @param string $message
     * @return array|string
     */
    public function announce(string $message)
    {
        return $this->executeCommand(__FUNCTION__, get_defined_vars());
    }
}
