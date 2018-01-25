<?php

namespace Example\Jobs;

use RodrigoIII\JobInterface;

class PunchDown implements JobInterface
{
    public function process()
    {
        echo "Punch down!";
    }
}