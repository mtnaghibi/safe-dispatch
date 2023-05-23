<?php

namespace Mtnaghibi\SafeDispatch\Tests;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mtnaghibi\SafeDispatch\traits\SafeDispatchable;

class FakeJob implements ShouldQueue
{
    use Queueable;
    use SafeDispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    public function __construct()
    {
        $this->queue = "default";
    }

    public function handle()
    {
        //Do Somethings
    }
}
