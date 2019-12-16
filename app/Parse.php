<?php


namespace app\parse;


class Parse
{
    public function __construct()
    {
    }

    function parse($url)
    {
        if (!preg_match("/http:\/\//i", $url) || !preg_match("/http:\/\//i", $url)) {
            echo 'Your URL was without protocol — we added protocol' . PHP_EOL;
            echo $url = 'https://' . $url . PHP_EOL;
        }
        print_r(parse_url($url));
    }
}