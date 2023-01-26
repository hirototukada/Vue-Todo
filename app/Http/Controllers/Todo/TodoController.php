<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoAddRequest;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    private $user;
    private $todo;

    public function __construct(User $user, Todo $todo)
    {
        $this->user = $user;
        $this->todo = $todo;
    }
    public function index(): string
    {
        return 'テスト通信';
    }
    /**
     * 新規登録処理
     *
     * @param TodoAddRequest $request
     * @return void
     */
    public function todoAdd(TodoAddRequest $request)
    {
        Log::info('This is info Logging.');
        // 登録処理
        $response = $this->todo->store($request);

        return 'test';
    }
}
