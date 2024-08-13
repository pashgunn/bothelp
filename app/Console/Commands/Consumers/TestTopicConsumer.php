<?php

namespace App\Console\Commands\Consumers;

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
            ->withHandler(function ($message) {
                sleep(1);

                logger()->info('Proceed event', [
                    'body' => $message->getBody(),
                    'partition' => $message->getPartition(),
                    'key' => $message->getKey(),
                ]);
            })
            ->build();

        try {
        $consumer->consume();
        } catch (Exception|ConsumerException $e) {
            logger()->error($e);
        }
    }
}
