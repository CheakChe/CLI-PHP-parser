<?php

use App\Components\Workers\Worker;

while ($request = trim(readline('Enter your command: '))) {

    try {
        $worker = Worker::getWorker($request);
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
        continue;
    }

    $worker->work();
}