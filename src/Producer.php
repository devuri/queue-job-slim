<?php

namespace QueueJobSlim;

use Pheanstalk\Pheanstalk;

class Producer
{
    public static function send($job, $params = [])
    {
        global $container;
        $queue_job = $container['settings']['queue-job'];
        $host = $queue_job['host'];

        $class = "\\{$queue_job['job_namespace']}\\{$job}";

        $pheanstalk = new Pheanstalk($host);
        $pheanstalk->useTube($job)->put(json_encode(compact('class', 'params')));
    }
}