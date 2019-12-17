<?php


namespace App\Components\Workers;


class Help extends Worker
{
    /**
     * @var false|string
     */
    private $help;

    public function __construct()
    {
        $this->help = file_get_contents('README.me');
    }

    function work()
    {
        echo $this->help;
    }
}