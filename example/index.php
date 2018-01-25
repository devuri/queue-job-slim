<?php

require __DIR__ . "/../vendor/autoload.php";

ini_set("display_errors", 1);

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true,

        'queue-job' => [
            'host' => "127.0.0.1",
            'job_namespace' => "Example\Jobs"
        ]
    ]
]);

$container = $app->getContainer();

$app->get('/test', function ()
{
    new RodrigoIII\Producer("PunchDown");
    new RodrigoIII\Producer("PunchUp");
});

$app->run();