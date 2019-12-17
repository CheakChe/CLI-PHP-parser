<?php


namespace app\help;

use app\basic\Basic as Basic;

class Help implements Basic
{
    /**
     * @var false|string
     */
    private $help;

    public function __construct()
    {
        $this->help = file_get_contents('README.me');
    }

    function index()
    {
        echo $this->help;
    }
}