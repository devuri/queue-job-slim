<?php

namespace Example\Jobs;

use RodrigoIII\QueueJob\JobInterface;

class PunchUp implements JobInterface
{
    protected $a;

    public function __construct($a)
    {
        $this->a = $a;
    }

    public function process()
    {
        echo "Punch up! {$a}";
    }
}