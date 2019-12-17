<?php

namespace App\Exceptions;

class UnknownCommand extends \Exception
{
    protected $code = 500;

    public function __construct(string $command)
    {
        parent::__construct();

        $this->message = "Unknown command '$command'" . PHP_EOL . 'Enter «help» for showing all command.' . PHP_EOL;;
    }
}