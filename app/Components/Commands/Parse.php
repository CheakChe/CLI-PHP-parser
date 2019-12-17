<?php


namespace App\Components\Commands;


class Parse extends Command
{
    /**
     * @var array
     */
    private $old;
    private $basic_url;

    public function __construct()
    {
        $this->old = array();
    }

    function work()
    {
        $url = readline('Enter site URL for parsing: ');
        $this->basic_url = $url;
        if ($url{strlen($url) - 1} == '/') $url = substr($url, 0, -1);
        if (parse_url($url, PHP_URL_SCHEME) == NULL) {
            echo 'Your URL was without protocol — we added protocol.' . PHP_EOL;
            echo $url = 'https://' . $url;
        }
        echo PHP_EOL;
        $this->getImg($url);
    }

    function getImg($url)
    {
        $site = file_get_contents($url);
        $this->old[] = $url;
        preg_match_all('/<a.*href="(.+)".*>/U', $site, $all_url);
        preg_match_all('/<img.*src="(.+)".*>/U', $site, $img);
        foreach ($img[1] as &$match) {
            if (parse_url($this->basic_url, PHP_URL_HOST) == parse_url($match, PHP_URL_HOST)) {
                $page_img[] = $url . ',' . $match;
            } elseif (parse_url($match, PHP_URL_HOST) == NULL) {
                $page_img[] = $url . ',' . $url . $match;
            }
        }
        $csv = fopen('img.csv', 'a');
        foreach ($page_img as $img) {
            fputcsv($csv, (array)$img);
        }
        fclose($csv);
        foreach ($all_url[1] as &$all_urll) {
            if (!in_array($all_urll, $this->old)) {
                $this->getImg($all_urll);
            }
        }
    }
}