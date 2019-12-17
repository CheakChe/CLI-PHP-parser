<?php


namespace App\Components\Commands;


class Help extends Command
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