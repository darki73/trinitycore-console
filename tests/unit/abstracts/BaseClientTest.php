<?php namespace FreedomCore\TrinityCore\Console\Tests\Unit\Abstracts;

use FreedomCore\TrinityCore\Console\Abstracts\BaseClient;
use FreedomCore\TrinityCore\Console\Client;
use FreedomCore\TrinityCore\Console\Tests\BaseTest;

/**
 * Class BaseClientTest
 * @package FreedomCore\TrinityCore\Console\Tests\Unit\Abstracts
 */
class BaseClientTest extends BaseTest
{

    /**
     * Username used for testing purposes
     * @var string
     */
    protected $testUsername = '2#1';

    /**
     * Password used for testing purposes
     * @var string
     */
    protected $testPassword = 'testPassword';

    /**
     * Test that SOAP extension is available
     */
    public function testSoapEnabled()
    {
        if (!extension_loaded('soap')) {
            $this->markTestSkipped(
                'The SOAP extension is not available.'
            );
        } else {
            $this->assertTrue(true);
        }
    }

    /**
     * Test Client Creation
     * @depends testSoapEnabled
     */
    public function testClientCreation()
    {
        /**
         * @var $client Client
         */
        $client = $this->createClient();
        $this->assertEquals($this->testUsername, $client->getUsername());
        $this->assertEquals($this->testPassword, $client->getPassword());
    }

    /**
     * Check if we are able to change username
     * @depends  testClientCreation
     */
    public function testClientUsernameChange()
    {
        $client = $this->createClient();
        $client->setUsername('3#1');
        $this->assertEquals('3#1', $client->getUsername());
    }

    /**
     * Check if we are able to change password
     * @depends testClientUsernameChange
     */
    public function testClientPasswordChange()
    {
        $client = $this->createClient();
        $client->setPassword('secretPassword');
        $this->assertEquals('secretPassword', $client->getPassword());
    }

    /**
     * Check if we are able to get/set address
     * @depends testClientPasswordChange
     */
    public function testClientHostGetSet()
    {
        $client = $this->createClient();
        $this->assertEquals('127.0.0.1', $client->getAddress());
        $client->setAddress('127.0.0.2');
        $this->assertEquals('127.0.0.2', $client->getAddress());
    }

    /**
     * Check if we are able to get/set port
     * @depends testClientHostGetSet
     */
    public function testClientPortGetSet()
    {
        $client = $this->createClient();
        $this->assertEquals(7878, $client->getPort());
        $client->setPort(7879);
        $this->assertEquals(7879, $client->getPort());
    }

    /**
     * Check that we are able to get client version
     */
    public function testClientGetVersion()
    {
        $client = $this->createClient();
        $this->assertEquals(BaseClient::VERSION, $client->getVersion());
    }

    /**
     * Check that we are able to get valid client instance
     * @depends testClientGetVersion
     */
    public function testClientGetClient()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(\SoapClient::class, $client->getClient());
    }

    /**
     * Create client
     * @return Client
     */
    protected function createClient() : Client
    {
        return new Client($this->testUsername, $this->testPassword);
    }
}
