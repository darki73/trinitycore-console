<?php namespace FreedomCore\TrinityCore\Console\Abstracts;

/**
 * Class BaseCommand
 * @package FreedomCore\TrinityCore\Console\Abstracts
 */
abstract class BaseCommand
{

    /**
     * Client Instance Object
     * @var null|\SoapClient
     */
    protected $clientInstance = null;

    /**
     * Name of the command
     * @var null|string
     */
    protected $command = null;

    /**
     * Available methods
     * @var array
     */
    protected $methods = [];

    /**
     * Commands which do not need to be prefixed with BASE command
     * @var array
     */
    protected $doNotPrefix = [];

    /**
     * Commands which methods should be concatenated
     * @var array
     */
    protected $concatenate = [];

    /**
     * BaseCommand constructor.
     * @param \SoapClient $client
     */
    public function __construct(\SoapClient $client)
    {
        $this->clientInstance = $client;
        $this->prepareCommand();
        $this->prepareMethods();
    }

    /**
     * Get Command Name
     * @return string
     */
    public function getCommandName() : string
    {
        return $this->command;
    }

    /**
     * Get Command Methods
     * @return array
     */
    public function getCommandMethods() : array
    {
        return $this->methods;
    }

    /**
     * Execute Help Command
     * @param string $methodName
     * @return array
     * @codeCoverageIgnore
     */
    public function help(string $methodName = '')
    {
        return $this->processOutput($this->clientInstance->executeCommand(new \SoapParam(trim(sprintf('help %s %s', $this->command, $methodName)), 'command')), true);
    }

    /**
     * Add quotes to string
     * @param string $string
     * @return string
     */
    public function inQuotes(string $string) : string
    {
        return '"' . $string . '"';
    }

    /**
     * Prepare Command Name Variable
     */
    protected function prepareCommand()
    {
        $this->command = strtolower((new \ReflectionClass(get_called_class()))->getShortName());
    }

    /**
     * Prepare Available Methods For Specified Command
     */
    protected function prepareMethods()
    {
        $globalMethods = get_class_methods(get_called_class());
        $classMethods = array_diff($globalMethods, [
            '__construct',
            'prepareCommand',
            'prepareMethods',
            'generateCommand',
            'generateQueryString',
            'executeCommand',
            'processOutput',
            'help',
            'inQuotes',
            'parseCommand',
            'getCommandName',
            'getCommandMethods'
        ]);
        foreach ($classMethods as $method) {
            $command = $this->generateCommand($method);
            $this->methods[$method] = [
                'command'   =>  $command,
                'query'     =>  $this->generateQueryString(get_called_class(), $method)
            ];
        }
    }

    /**
     * Generate Command String
     * @param string $method
     * @return string
     */
    protected function generateCommand(string $method) : string
    {
        preg_match_all('/((?:^|[A-Z])[a-z]+)/', $method, $matches);
        $elements = array_map('strtolower', $matches[0]);
        $command = (!in_array($method, $this->doNotPrefix)) ? implode(' ', array_merge([$this->command], $elements)) : implode(' ', $elements);
        if (in_array($method, $this->concatenate)) {
            $command = $this->command . $method;
        }
        return trim($this->parseCommand($command));
    }

    /**
     * Generate Command Query String
     * @param string $class
     * @param string $method
     * @return string
     */
    protected function generateQueryString(string $class, string $method) : string
    {
        $reflection =  new \ReflectionMethod($class, $method);
        return implode(' ', array_map(function ($item) {
            return '%' . $item->getName() . '%';
        }, $reflection->getParameters()));
    }

    /**
     * Execute Command
     * @param string $methodName
     * @param array $parameters
     * @return array|string
     * @codeCoverageIgnore
     */
    protected function executeCommand(string $methodName, array $parameters)
    {
        $structure = [
            'class'         =>  get_called_class(),
            'method'        =>  $methodName,
            'parameters'    =>  $parameters,
            'query'         =>  $this->methods[$methodName]
        ];
        $structure['query']['prepared'] = str_replace('  ', ' ', trim(implode(' ', [
            $structure['query']['command'],
            str_replace(explode(' ', $structure['query']['query']), $structure['parameters'], $structure['query']['query'])
        ])));
        try {
            return $this->processOutput(
                $this->clientInstance->executeCommand(new \SoapParam(trim($structure['query']['prepared']), 'command'))
            );
        } catch (\SoapFault $exception) {
            return [
                'status'    =>  'failed',
                'code'      =>  $exception->getCode(),
                'message'   =>  trim($exception->getMessage()),
                'query'     =>  trim($structure['query']['prepared'])
            ];
        }
    }

    /**
     * Process Response
     * @param string $commandOutput
     * @param bool $helpFunction
     * @return array
     * @codeCoverageIgnore
     */
    protected function processOutput(string $commandOutput, bool $helpFunction = false)
    {
        return array_filter(explode(PHP_EOL, $commandOutput));
    }

    /**
     * Parse and Process Command
     * @param string $command
     * @return string
     */
    protected function parseCommand(string $command) : string
    {
        $replacements = [
            'gm level'              =>  'gmlevel',
            'game account create'   =>  'gameaccountcreate',
            'list game accounts'    =>  'listgameaccounts',
            'diff time'             =>  'difftime',
            'log level'             =>  'loglevel',
            'save all'              =>  'saveall',
            'name announce'         =>  'nameannounce',
            'change faction'        =>  'changefaction',
            'change race'           =>  'changerace'
        ];
        foreach ($replacements as $key => $value) {
            if (strstr($command, $key)) {
                $command = str_replace($key, $value, $command);
                break;
            }
        }
        return $command;
    }
}
