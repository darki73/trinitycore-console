<?php namespace FreedomCore\TrinityCore\Console\Abstracts;

/**
 * Class BaseCommand
 * @package FreedomCore\TrinityCore\Console\Abstracts
 */
abstract class BaseCommand {

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
    public function __construct(\SoapClient $client) {
        $this->clientInstance = $client;
        $this->prepareCommand();
        $this->prepareMethods();
    }

    /**
     * Execute Help Command
     * @param string $methodName
     * @return string
     */
    public function help(string $methodName = '') {
        return $this->processOutput($this->clientInstance->executeCommand(new \SoapParam(trim(sprintf('help %s %s', $this->command, $methodName)), 'command')), true);
    }

    /**
     * Prepare Command Name Variable
     */
    protected function prepareCommand() {
        $this->command = strtolower((new \ReflectionClass(get_called_class()))->getShortName());
    }

    /**
     * Prepare Available Methods For Specified Command
     */
    protected function prepareMethods() {
        $globalMethods = get_class_methods(get_called_class());
        $classMethods = array_diff($globalMethods, ['__construct', 'prepareCommand', 'prepareMethods', 'generateCommand', 'generateQueryString', 'executeCommand', 'processOutput', 'help', 'inQuotes']);
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
    protected function generateCommand(string $method) : string {
        preg_match_all('/((?:^|[A-Z])[a-z]+)/', $method, $matches);
        $elements = array_map('strtolower', $matches[0]);
        if (!in_array($method, $this->doNotPrefix))
            $command = implode(' ', array_merge([$this->command], $elements));
        else
            $command = implode(' ', $elements);
        if (in_array($method, $this->concatenate))
            $command = $this->command . $method;
        if (strstr($command, 'gm level'))
            $command = str_replace('gm level', 'gmlevel', $command);
        if (strstr($command, 'game account create'))
            $command = str_replace('game account create', 'gameaccountcreate', $command);
        if (strstr($command, 'list game accounts'))
            $command = str_replace('list game accounts', 'listgameaccounts', $command);
        if (strstr($command, 'diff time'))
            $command = str_replace('diff time', 'difftime', $command);
        if (strstr($command, 'log level'))
            $command = str_replace('log level', 'loglevel', $command);
        if (strstr($command, 'save all'))
            $command = str_replace('save all', 'saveall', $command);
        if (strstr($command, 'name announce'))
            $command = str_replace('name announce', 'nameannounce', $command);
        if (strstr($command, 'change faction'))
            $command = str_replace('change faction', 'changefaction', $command);
        if (strstr($command, 'change race'))
            $command = str_replace('change race', 'changerace', $command);
        return trim($command);
    }

    /**
     * Generate Command Query String
     * @param string $class
     * @param string $method
     * @return string
     */
    protected function generateQueryString(string $class, string $method) : string {
        $reflection =  new \ReflectionMethod($class, $method);
        return implode(' ', array_map(function( $item ) { return '%' . $item->getName() . '%'; }, $reflection->getParameters()));
    }

    /**
     * Add quotes to string
     * @param string $string
     * @return string
     */
    protected function inQuotes(string $string) : string {
        return '"' . $string . '"';
    }

    /**
     * Execute Command
     * @param string $methodName
     * @param array $parameters
     * @return array|string
     */
    protected function executeCommand(string $methodName, array $parameters) {
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

    protected function processOutput(string $commandOutput, bool $helpFunction = false) {
        $responseToArray = array_filter(explode(PHP_EOL, $commandOutput));
        dd(array_filter(explode(PHP_EOL, $commandOutput)));

        return '123';
    }

}