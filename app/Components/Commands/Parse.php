<?php


namespace App\Components\Commands;


class Parse extends Command
{
    /**
     * @var array
     */
    private $old;
    private $basic_url;
    private $iterator;
    private $file;

    public function __construct()
    {
        $this->old = array();
        $this->iterator = 0;
    }

    function work()
    {
        $url = readline('Enter site URL for parsing: ');
        $this->basic_url = $this->deleteSlash(parse_url($url, PHP_URL_HOST));
        if (parse_url($url, PHP_URL_SCHEME) == NULL) {
            echo 'Your URL was without protocol — we added protocol.' . PHP_EOL;
            echo $url = 'https://' . $url;
        }
        echo PHP_EOL;
        $this->getImg($url);
        return 'Your file is here: ' . $this->file . PHP_EOL;
    }

    function getImg($url)
    {
        $url = $this->deleteSlash($url);
        $site = @file_get_contents($url);
        if ($site === FALSE) {
            return 'No correct URL';
        }
        $this->old[] = $url;
        preg_match_all('/<a.*href="(.+)".*>/U', $site, $parse_url);
        preg_match_all('/<img.*src="(.+)".*>/U', $site, $parse_img);
        foreach ($parse_url[1] as $key => $item) {
            $item_host = parse_url($item, PHP_URL_HOST);
            if (preg_match("@^" . $this->basic_url . "@i", $item_host) || preg_match("@^www." . $this->basic_url . "@i", $item_host)) {
                $urls[] = $this->deleteSlash($item);
            } else if ($item_host == NULL) {
                $urls[] = 'https://' . $this->basic_url . $this->addSlash($this->deleteSlash($item));
            }
        }
        foreach ($parse_img[1] as $key => $item) {
            $item_host = parse_url($item, PHP_URL_HOST);
            if ($item_host == NULL) {
                $imgs[] = $url . $this->addSlash($this->deleteSlash($item));
            } else {
                $imgs[] = $this->deleteSlash($item);
            }
        }
        if (isset($imgs)) {
            $this->createFile('img', $imgs, $url);
        }
        if (isset($urls)) {
            $this->childURL($urls);
        }
    }

    function deleteSlash($url)
    {
        if ($url{strlen($url) - 1} == '/') $url = substr($url, 0, -1);
        return $url;
    }

    function addSlash($url)
    {
        if (!empty($url)) {
            if ($url[0] != '/') @$url = '/' . $url;
        }
        return $url;
    }

    function createFile($name, $data, $url = '')
    {
        $this->file = 'files/parsing/' . $this->basic_url . '_' . $name . '_' . date("d.m.Y") . '.csv';
        var_dump($this->file);
        die;
        $csv = fopen($this->file, 'a');
        foreach ($data as $row) {
            if ($url != '') {
                $link = $url . ';' . $row . ';';
            } else {
                $link = $row . ';';
            }
            fputcsv($csv, (array)$link);
        }
    }

    function childURL($urls)
    {
        foreach ($urls as $new_url) {
            if ($this->iterator > 100) {
                $this->createFile('repeat', $this->old);
                return 'Repetition of past links more than a hundred times in a row therefore we stop the search';
            }
            if (!in_array($new_url, $this->old)) {
                $this->getImg($new_url);
                $this->iterator = 0;
            } else {
                $this->iterator += 1;
            }
        }
    }
}