<?php

namespace RodrigoIII\QueueJob;

use Pheanstalk\Pheanstalk;
use Utilities\Console;

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
            exit(Console::red("Cannot connect on host {$this->host}") . PHP_EOL);

        echo Console::green("Listening {$this->host} ...") . PHP_EOL;

        foreach ($test_tubes as $test_tube) {
            $this->pheanstalk->watch($test_tube);
        }

        while ($job = $this->pheanstalk->reserve()) {
            echo Console::yellow("Processing ...") . PHP_EOL;

            $class = $job->getData();
            $job_class = new $class;
            $job_class->process();

            echo PHP_EOL . Console::green("done.") . PHP_EOL;
            $this->pheanstalk->delete($job);
        }
    }
}