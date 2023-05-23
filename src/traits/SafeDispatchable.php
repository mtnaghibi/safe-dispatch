<?php

namespace Mtnaghibi\SafeDispatch\traits;

use Throwable;
use ReflectionMethod;
use Illuminate\Support\Carbon;
use Laravel\Horizon\RedisQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\Dispatchable;

trait SafeDispatchable
{
    use Dispatchable {
        dispatch as private parentDispatch;
    }

    public static function dispatch(...$arguments): void
    {
        try {
            self::parentDispatch(...$arguments);
        } catch (Throwable $exception) {
            (new static(...$arguments))->markAsFailed($exception);
        }
    }

    private function markAsFailed(Throwable $exception): void
    {
        $reflection = new ReflectionMethod(RedisQueue::class, 'createPayloadArray');
        $payload = $reflection->invoke(app(RedisQueue::class), $this, $this->queue);
        $data = [
            'uuid' => $payload['uuid'],
            'connection' => $this->connection ?? config('queue.default'),
            'queue' => $this->queue,
            'payload' => json_encode($payload, JSON_UNESCAPED_UNICODE),
            'exception' => $exception->getMessage(),
            'failed_at' => Carbon::now(),
        ];
        DB::table('failed_jobs')->insert($data);
    }
}
