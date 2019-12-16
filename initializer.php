<?php

use app\help\Help as Help;
use app\parse\Parse as Parse;
use app\report\Report as Report;

while (true) {
    switch ($request = readline('Enter your request: ')) {
        case'parse':
            $url = readline('Enter site URL for parsing: ');
            $parse = new Parse();
            $parse->parse($url);
            break;
        case'report':
            $help = new Help();
            $help->help();
            break;
        case'help':
            $report = new Report();
            $report->report();
            break;
        case'exit':
            exit('Thank for using');
    }
}