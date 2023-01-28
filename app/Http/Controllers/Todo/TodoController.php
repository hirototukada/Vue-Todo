<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoAddRequest;
use App\Models\Todo;
use App\Models\User;

class TodoController extends Controller
{
    private $user;
    private $todo;

    public function __construct(User $user, Todo $todo)
    {
        $this->user = $user;
        $this->todo = $todo;
    }

    /**
     * 取得処理
     *
     * @return array
     */
    public function index(): array
    {
        // Todoタスク取得処理
        $todoParam = $this->todo->getData();

        return $todoParam;
    }
    /**
     * 新規登録処理
     *
     * @param TodoAddRequest $request
     * @return void
     */
    public function todoAdd(TodoAddRequest $request)
    {
        // 登録処理
        $response = $this->todo->store($request);

        return $response;
    }
}
