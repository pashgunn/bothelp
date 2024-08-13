<?php

namespace App\DTO;

class KafkaProducerDTO
{
    public string $topic;

    public string $key;

    public int $account_id;

    public int $event_id;
}
