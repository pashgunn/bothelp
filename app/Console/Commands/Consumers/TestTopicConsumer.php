<?php

namespace App\Console\Commands\Consumers;

use App\Handlers\TestHandler;
use Carbon\Exceptions\Exception;
use Illuminate\Console\Command;
use Junges\Kafka\Exceptions\ConsumerException;
use Junges\Kafka\Facades\Kafka;

class TestTopicConsumer extends Command
{
    protected $signature = "consume:test-topic";

    protected $description = "Consume Kafka messages from 'test-topic'.";

    public function handle(): void
    {
        $consumer = Kafka::consumer()
            ->subscribe([config('kafka.topic')])
            ->withAutoCommit()
            ->withHandler(new TestHandler())
            ->build();

        try {
        $consumer->consume();
        } catch (Exception|ConsumerException $e) {
            logger()->error($e);
        }
    }
}
