<?php

namespace App\Http\Controllers;

class TodoController extends Controller
{
    public function index(): string
    {
        return 'テスト通信';
    }

    public function todoAdd()
    {
        return 'test';
    }
}
