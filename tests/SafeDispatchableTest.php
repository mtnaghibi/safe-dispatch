<?php

namespace Mtnaghibi\SafeDispatch\Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class SafeDispatchableTest extends TestCase
{

    public function test_dispatch_shouldSuccess()
    {
        Config::set("queue.default", "database");

        FakeJob::dispatch();

        $this->assertCount(0, DB::table('failed_jobs')->get());


    }

    public function test_dispatch_shouldFail()
    {
        Config::set("queue.default", "redis");

        FakeJob::dispatch();

        $this->assertCount(1, DB::table('failed_jobs')->get());

    }
}
