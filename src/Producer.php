<?php

namespace RodrigoIII\QueueJob;

use Pheanstalk\Pheanstalk;

class Producer
{
    public function __construct($test_tube)
    {
        global $container;

        $queue_job = $container['settings']['queue-job'];

        $this->pheanstalk = new Pheanstalk($queue_job['host']);
        $this->send($test_tube, "\\{$queue_job['job_namespace']}\\$test_tube");
    }

    public function send($test_tube, $job_class)
    {
        $this->pheanstalk->useTube($test_tube)->put($job_class);
    }
}