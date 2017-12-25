<?php namespace FreedomCore\TrinityCore\Console\Tests\Unit;

use FreedomCore\TrinityCore\Console\Client;
use FreedomCore\TrinityCore\Console\Commands\Account;
use FreedomCore\TrinityCore\Console\Commands\BNetAccount;
use FreedomCore\TrinityCore\Console\Commands\Character;
use FreedomCore\TrinityCore\Console\Commands\GM;
use FreedomCore\TrinityCore\Console\Commands\Guild;
use FreedomCore\TrinityCore\Console\Commands\LFG;
use FreedomCore\TrinityCore\Console\Commands\Reset;
use FreedomCore\TrinityCore\Console\Commands\Send;
use FreedomCore\TrinityCore\Console\Commands\Server;
use FreedomCore\TrinityCore\Console\Tests\BaseTest;

/**
 * Class ClientTest
 * @package FreedomCore\TrinityCore\Console\Tests\Unit
 */
class ClientTest extends BaseTest
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
     * Check if the returned value is an instance of Account
     * @depends testSoapEnabled
     */
    public function testClientIsInstanceOfAccount()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(Account::class, $client->account());
    }

    /**
     * Check if the returned value is an instance of BNetAccount
     * @depends testSoapEnabled
     */
    public function testClientIsInstanceOfBNetAccount()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(BNetAccount::class, $client->bnet());
    }

    /**
     * Check if the returned value is an instance of Character
     * @depends testSoapEnabled
     */
    public function testClientIsInstanceOfCharacter()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(Character::class, $client->character());
    }

    /**
     * Check if the returned value is an instance of GM
     * @depends testSoapEnabled
     */
    public function testClientIsInstanceOfGM()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(GM::class, $client->gm());
    }

    /**
     * Check if the returned value is an instance of Guild
     * @depends testSoapEnabled
     */
    public function testClientIsInstanceOfGuild()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(Guild::class, $client->guild());
    }

    /**
     * Check if the returned value is an instance of LFG
     * @depends testSoapEnabled
     */
    public function testClientIsInstanceOfLFG()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(LFG::class, $client->lfg());
    }

    /**
     * Check if the returned value is an instance of Reset
     * @depends testSoapEnabled
     */
    public function testClientIsInstanceOfReset()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(Reset::class, $client->reset());
    }

    /**
     * Check if the returned value is an instance of Send
     * @depends testSoapEnabled
     */
    public function testClientIsInstanceOfSend()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(Send::class, $client->send());
    }

    /**
     * Check if the returned value is an instance of Server
     * @depends testSoapEnabled
     */
    public function testClientIsInstanceOfServer()
    {
        $client = $this->createClient();
        $this->assertInstanceOf(Server::class, $client->server());
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
