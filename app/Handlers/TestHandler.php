<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Log;
use Junges\Kafka\Contracts\MessageConsumer;
use Junges\Kafka\Contracts\ConsumerMessage;

class TestHandler
{
    public function __invoke(ConsumerMessage $message, MessageConsumer $consumer): void
    {
        logger()->info('Message received!', [
            'body' => $message->getBody(),
            'headers' => $message->getHeaders(),
            'partition' => $message->getPartition(),
            'key' => $message->getKey(),
            'topic' => $message->getTopicName()
        ]);
    }
}
