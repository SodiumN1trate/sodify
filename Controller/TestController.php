<?php

namespace Controller;

use Core\Database;
use Model\User;

class TestController
{
    public function test(): string
    {
        return responseJSON([
            'message' => 'Hello, world!',
        ]);
    }

    public function ping()
    {
//        dd(User::all());
//        dd(Database::table('users')->where('id', '=', '1')->orWhere('name', '=', 'sodik')->first());
//        dd(Database::table('users')->find(3));
        $user = new User([
            'name' => 'tests',
            'surname' => 'tests123',
        ]);
//        dd($user);
        return responseJSON(User::all());
//        return json_decode($user);
//        dd($user->surname);
    }

    public function create($body) {
        dd('blah', $body);
    }
}