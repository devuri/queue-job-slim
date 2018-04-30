<?php

namespace QueueJobSlim;

use Pheanstalk\Pheanstalk;
use QueueJobSlim\Utilities\Console;

class Worker
{
    public function __construct($host)
    {
        $this->host = $host;
        $this->pheanstalk = new Pheanstalk($this->host);
    }

    public function listen(array $test_tubes)
    {
        if (!$this->pheanstalk->getConnection()->isServiceListening())
        {
            exit(Console::red("Cannot connect on host {$this->host}") . PHP_EOL);
        }

        echo Console::green("Listening {$this->host} ...") . PHP_EOL;

        foreach ($test_tubes as $test_tube)
        {
            $this->pheanstalk->watch($test_tube);
        }

        while ($job = $this->pheanstalk->reserve())
        {
            echo Console::yellow("Processing ...") . PHP_EOL;

            $data = json_decode($job->getData());

            $class = $data->class;
            $params = $data->params;

            if (class_exists($class))
            {
                $job_reflection_class = new \ReflectionClass($class);
                $class_instance = $job_reflection_class->newInstanceArgs($params);
                $class_instance->handle();
            }
            else
            {
                error_log("Class {$class} is not exist.");
            }

            echo PHP_EOL . Console::green("done.") . PHP_EOL;
            $this->pheanstalk->delete($job);
        }
    }
}