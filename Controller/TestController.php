<?php

namespace Controller;

class TestController
{
    public function test(): string
    {
        $response = json_encode(['message' => 'Hello, world!']);
        return responseJSON($response);
    }

    public function ping(): string
    {
        return 'pong';
    }

    public function create($body) {
        dd('blah', $body);
    }
}