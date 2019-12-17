<?php


namespace App\Components\Workers;


use App\Exceptions\UnknownCommand;

abstract class Worker
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
    final static public function getWorker(string $workerKey): self
    {
        switch ($workerKey) {
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
                throw new UnknownCommand($workerKey);
                break;
        }
    }
}