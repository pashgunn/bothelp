<?php

namespace App\Handlers;

use Junges\Kafka\Contracts\MessageConsumer;
use Junges\Kafka\Contracts\ConsumerMessage;

class TestHandler
{
    public function __invoke(ConsumerMessage $message, MessageConsumer $consumer): void
    {
        sleep(1);

        logger()->info('Proceed event', [
            'body' => $message->getBody(),
            'partition' => $message->getPartition(),
            'key' => $message->getKey(),
        ]);
    }
}
