<?php


namespace App\Components\Commands;


class Report extends Command
{
    public function __construct()
    {
    }

    function work()
    {
        $url = readline('Enter site URL for parsing: ');
        if ($url{strlen($url) - 1} == '/') $url = substr($url, 0, -1);
        if (parse_url($url, PHP_URL_SCHEME) == NULL) {
            echo 'Your URL was without protocol — we added protocol.' . PHP_EOL;
            echo $url = 'https://' . $url;
        }
        echo PHP_EOL;
        $site = file_get_contents($url);
//        preg_match_all('/<a.*href="(.+)".*>/U', $site, $url);
        preg_match_all('/<img.*src="(.+)".*>/U', $site, $img);
        $page_img['link'] = $url;
        foreach ($img[1] as &$match) {
            var_dump(parse_url($match));
            if (parse_url($url, PHP_URL_HOST) == parse_url($match, PHP_URL_HOST)) {
                $page_im[] = $match;
            } elseif (parse_url($match, PHP_URL_HOST) == NULL) {
                $page_img[] = $url . $match;
            }
        }
        var_dump($page_img);
    }
}