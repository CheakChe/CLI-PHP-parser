<?php

use app\parse\Parse;

while (true) {
    $request = trim(readline('Enter your request: '));
    if ($request == 'parse' || $request == 'help' || $request == 'report') {
        $request[0] = mb_strtoupper($request[0]);
        $class = new Parse();
        $class->index();
    } elseif ($request == 'exit') exit('Thank for using');
    else echo 'Command not found!' . PHP_EOL . 'Enter «help» for showing all command.' . PHP_EOL;

}