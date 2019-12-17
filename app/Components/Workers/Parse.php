<?php


namespace App\Components\Workers;


class Parse extends Worker
{
    public function __construct()
    {
    }


    function work()
    {
        $url = readline('Enter site URL for parsing: ');
        if (!preg_match("/http:\/\//i", $url) || !preg_match("/https:\/\//i", $url)) {
            echo 'Your URL was without protocol — we added protocol.' . PHP_EOL;
            echo $url = 'https://' . $url;
        }
        echo PHP_EOL;
        $site = file_get_contents($url);
        preg_match_all('/<a.*href="(.+)".*>/U', $site, $match);
//        preg_match_all('/<img.*src="(.+)".*>/U', $site, $match);
        foreach ($match[1] as &$match) {
            echo $match = $url . $match . PHP_EOL;
        }
        print_r($match[1]);
    }
}