<?php

use App\Components\Commands\Command;

while ($request = trim(readline('Enter your command: '))) {

    try {
        $command = Command::getCommand($request);
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
        continue;
    }

    echo $command->work();
//    $command->description();
}