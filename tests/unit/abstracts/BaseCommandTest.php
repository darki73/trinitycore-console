<?php namespace FreedomCore\TrinityCore\Console\Tests\Unit\Abstracts;

use FreedomCore\TrinityCore\Console\Abstracts\BaseCommand;
use FreedomCore\TrinityCore\Console\Client;
use FreedomCore\TrinityCore\Console\Tests\BaseTest;

/**
 * Class BaseCommandTest
 * @package FreedomCore\TrinityCore\Console\Tests\Unit\Abstracts
 */
class BaseCommandTest extends BaseTest
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
     * Test Command Creation
     * @depends testSoapEnabled
     */
    public function testCommandCreation()
    {
        /**
         * @var $command BaseCommand
         */
        $command = $this->createCommand();
        $this->assertEquals('mock', $command->getCommandName());
    }

    /**
     * Test that we are able to get command classes
     * and concatenation and prefixing working
     * @depends testCommandCreation
     */
    public function testCommandMethods()
    {
        $command = $this->createCommand();
        $this->assertEquals($this->mockClassMethods(), $command->getCommandMethods());
    }

    /**
     * Check that the 'inQuotes' method works as expected
     * @depends testCommandMethods
     */
    public function testCommandInQuotes()
    {
        $command = $this->createCommand();
        $this->assertEquals('"Test Message"', $command->inQuotes('Test Message'));
    }

    /**
     * Create client
     * @return Client
     */
    protected function createClient() : Client
    {
        return new Client($this->testUsername, $this->testPassword);
    }

    /**
     * Create Command
     * @return Mock
     */
    protected function createCommand() : Mock
    {
        return new Mock($this->createClient()->getClient());
    }

    /**
     * Methods and expected results for Mock Class
     * @return array
     */
    protected function mockClassMethods() : array
    {
        return [
            'testCommandSimple'  =>  [
                'command'   =>  'mock test command simple',
                'query'     =>  '%firstParameter% %secondParameter%'
            ],
            'testCommandNoPrefix'  =>  [
                'command'   =>  'test command no prefix',
                'query'     =>  '%firstParameter% %secondParameter%'
            ],
            'testCommandConcatenate'  =>  [
                'command'   =>  'mocktestCommandConcatenate',
                'query'     =>  '%firstParameter% %secondParameter%'
            ],
            'testCommandGmLevel'  =>  [
                'command'   =>  'mock test command gmlevel',
                'query'     =>  '%firstParameter% %secondParameter%'
            ]
        ];
    }
}

class Mock extends BaseCommand
{

    /**
     * @inheritdoc
     * @var array
     */
    protected $doNotPrefix = [
        'testCommandNoPrefix'
    ];

    /**
     * @inheritdoc
     * @var array
     */
    protected $concatenate = [
        'testCommandConcatenate'
    ];

    /**
     * Test Command Simple
     * Prefixed + Not Concatenated
     * @param string $firstParameter
     * @param string $secondParameter
     * @return bool
     */
    public function testCommandSimple(string $firstParameter, string $secondParameter) : bool
    {
        return true;
    }

    /**
     * Test Command With No Prefix
     * No Prefix + Not Concatenated
     * @param string $firstParameter
     * @param string $secondParameter
     * @return bool
     */
    public function testCommandNoPrefix(string $firstParameter, string $secondParameter) : bool
    {
        return true;
    }

    /**
     * Test Command Concatenate
     * Prefixed + Concatenated
     * @param string $firstParameter
     * @param string $secondParameter
     * @return bool
     */
    public function testCommandConcatenate(string $firstParameter, string $secondParameter) : bool
    {
        return true;
    }

    /**
     * Test Command Automatic Concatenation For Specific Words
     * @param string $firstParameter
     * @param string $secondParameter
     * @return bool
     */
    public function testCommandGmLevel(string $firstParameter, string $secondParameter) : bool
    {
        return true;
    }
}
