<?php

namespace Controller;

use Model\User;

class TestController
{
    public function test(): string
    {
        return responseJSON([
            'message' => 'Hello, world!',
        ]);
    }

    public function ping(): string
    {
        dd(User::all());
//        $user = new User([
//            'name' => 'tests',
//            'surname' => 'tests123',
//        ]);
//        dd($user->surname);
    }

    public function create($body) {
        dd('blah', $body);
    }
}