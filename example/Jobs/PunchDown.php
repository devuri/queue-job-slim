<?php

namespace Example\Jobs;

use RodrigoIII\QueueJob\JobInterface;

class PunchDown implements JobInterface
{
    public function process()
    {
        echo "Punch down!";
    }
}