<?php


namespace App\Components\Workers;


class Report extends Worker
{
    public function __construct()
    {
    }

    function work()
    {
        echo 'no work' . PHP_EOL;
    }
}