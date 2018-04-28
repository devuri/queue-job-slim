<?php

namespace QueueJobSlim;

interface JobInterface
{
    public function process();
}