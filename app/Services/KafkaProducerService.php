<?php

namespace App\Services;

use App\DTO\KafkaProducerDTO;
use Exception;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use Junges\Kafka\Producers\Builder;

class KafkaProducerService
{
    /**
     * @throws Exception
     */
    public function sendEvent(KafkaProducerDTO $dto): void
    {
        $message = new Message(
            body: [
                'account_id' => $dto->account_id,
                'event_id' => $dto->event_id,
            ],
            key: $dto->key
        );

        /** @var Builder $producer */
        $producer = Kafka::publish(config('kafka.brokers'))
            ->onTopic($dto->topic)
            ->withMessage($message)
            ->withKafkaKey($dto->key);

        $producer->send();
    }
}
