<?php

require __DIR__ . "/../vendor/autoload.php";

ini_set("display_errors", 1);

$jobs = glob(__DIR__ . "/Jobs/*.php");

$test_tubes = array_map(function ($job){
    return basename($job, ".php");
}, $jobs);

$queue = new RodrigoIII\Worker("127.0.0.1");
$queue->listen($test_tubes);