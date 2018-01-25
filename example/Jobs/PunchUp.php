<?php

namespace Example\Jobs;

use RodrigoIII\JobInterface;

class PunchUp implements JobInterface
{
    public function process()
    {
        echo "Punch up!";
    }
}