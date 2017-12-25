<?php namespace FreedomCore\TrinityCore\Console\Abstracts;

/**
 * Class BaseClient
 * @package FreedomCore\TrinityCore\Console\Abstracts
 */
abstract class BaseClient
{

    /**
     * Package Version
     * @var string
     */
    const VERSION = '1.0.2';

    /**
     * Server Address
     * @var string
     */
    protected $serverAddress = '127.0.0.1';

    /**
     * Server Port
     * @var int
     */
    protected $serverPort = 7878;

    protected $client = null;

    /**
     * Username used to connect to the server
     * @var null|string
     */
    private $username = null;

    /**
     * Password used to connect to the server
     * @var null|string
     */
    private $password = null;

    /**
     * BaseClient constructor.
     * @param string $username Username used to connect to the server
     * @param string $password Password used to connect to the server
     * @param boolean $createNow Should the connection be created as soon as possible
     * @throws \Exception
     */
    public function __construct(string $username, string $password, bool $createNow = true)
    {
        $this->isSoapEnabled();
        $this->username = $username;
        $this->password = $password;
        $this->validateSettings();
        if ($createNow) {
            $this->createConnection();
        }
    }

    /**
     * Set Server Address
     * @param string $serverAddress
     * @return BaseClient
     */
    public function setAddress(string $serverAddress) : BaseClient
    {
        $this->serverAddress = $serverAddress;
        return $this;
    }

    /**
     * Get Server Address
     * @return string
     */
    public function getAddress() : string
    {
        return $this->serverAddress;
    }

    /**
     * Set Server Port
     * @param int $serverPort
     * @return BaseClient
     */
    public function setPort(int $serverPort) : BaseClient
    {
        $this->serverPort = $serverPort;
        return $this;
    }

    /**
     * Get Server Port
     * @return int
     */
    public function getPort() : int
    {
        return $this->serverPort;
    }

    /**
     * Get Client Version
     * @return string
     */
    public function getVersion() : string
    {
        return Client::VERSION;
    }

    /**
     * Initialize Connection To The Server
     */
    public function createConnection()
    {
        $this->client = new \SoapClient(null, [
            'location'      =>  'http://' . $this->serverAddress . ':' . $this->serverPort . '/',
            'uri'           =>  'urn:TC',
            'login'         =>  $this->username,
            'password'      =>  $this->password,
            'style'         =>  SOAP_RPC,
            'keep_alive'    =>  false
        ]);
    }

    /**
     * Get Client Instance
     * @return \SoapClient
     */
    public function getClient() : \SoapClient
    {
        return $this->client;
    }

    /**
     * Check if SOAP extension is enabled
     * @throws \Exception
     */
    protected function isSoapEnabled()
    {
        if (!extension_loaded('soap')) {
            throw new \Exception('FreedomNet requires SOAP extension to be enabled.' . PHP_EOL . 'Please enable SOAP extension');
        }
    }

    /**
     * Validate Connection Settings
     */
    protected function validateSettings()
    {
        if ($this->serverAddress === null) {
            throw new \RuntimeException('SOAP Address cannot be null!');
        }
        if ($this->serverPort === null) {
            throw new \RuntimeException('SOAP Port cannot be null!');
        }
        if ($this->username === null) {
            throw new \RuntimeException('SOAP Username cannot be null!');
        }
        if ($this->password === null) {
            throw new \RuntimeException('SOAP Password cannot be null!');
        }
    }
}
