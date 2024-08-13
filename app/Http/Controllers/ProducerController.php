<?php

namespace App\Http\Controllers;

use App\DTO\KafkaProducerDTO;
use App\Services\KafkaProducerService;

class ProducerController
{
    /**
     * @throws \Exception
     */
    public function test(KafkaProducerService $producerService, KafkaProducerDTO $dto)
    {
        $events = [];

        for ($i = 1; $i <= 10000; $i++) {
            $accountId = rand(1, 1000);
            $events[] = [
                'account_id' => $accountId,
                'event_id' => $i,
            ];
        }

        $start = microtime(true);

        $dto->topic = config('kafka.topic');
        foreach ($events as $event) {
            $dto->key = (string)$event['account_id'];
            $dto->account_id = $event['account_id'];
            $dto->event_id = $event['event_id'];

            $producerService->sendEvent($dto);
        }

        return response()->json(microtime(true) - $start);
    }
}
