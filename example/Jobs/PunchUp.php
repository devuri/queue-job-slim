<?php

namespace Example\Jobs;

use RodrigoIII\QueueJob\JobInterface;

class PunchUp implements JobInterface
{
    public function process()
    {
        echo "Punch up!";
    }
}