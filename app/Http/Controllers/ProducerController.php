<?php

namespace App\Http\Controllers;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Producers\Builder;

class ProducerController
{
    /**
     * @throws \Exception
     */
    public function __invoke()
    {
        /** @var Builder $producer */
        $producer = Kafka::publish()
            ->onTopic('test-topic')
            ->withBodyKey('foo', 'bar')
            ->withHeaders([
                'foo-header' => 'foo-value'
            ])
            ->withDebugEnabled();

        $producer->send();

        return response()->json('Message published! 2');
    }
}
