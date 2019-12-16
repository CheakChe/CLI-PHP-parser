<?php


namespace app\help;


class Help
{
    public function __construct()
    {
        $help = file_get_contents('README.me');
    }

    function help()
    {
        echo $help;
    }
}