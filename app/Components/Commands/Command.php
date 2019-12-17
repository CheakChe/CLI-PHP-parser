<?php


namespace App\Components\Commands;


use App\Exceptions\UnknownCommand;

abstract class Command
{
    const PARSER_KEY = 'parse';
    const REPORT_KEY = 'report';
    const HELP_KEY = 'help';

    abstract function work();

    /**
     * @param string $workerKey
     * @return $this
     * @throws UnknownCommand
     */
    final static public function getCommand(string $commandKey): self
    {
        switch ($commandKey) {
            case self::PARSER_KEY:
                return new Parse();
                break;
            case self::REPORT_KEY:
                return new Report();
                break;
            case self::HELP_KEY:
                return new Help();
                break;
            default:
                throw new UnknownCommand($commandKey);
                break;
        }
    }
}