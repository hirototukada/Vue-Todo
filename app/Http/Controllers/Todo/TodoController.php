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
        // Todo取得処理
        $todoParam = $this->todo->getData();

        return $todoParam;
    }
    /**
     * id値から取得処理
     *
     * @param int $id
     * @return array
     */
    public function searchEditData($id)
    {
        // Todo取得処理
        $todoParam = $this->todo->getEditData($id);

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

    /**
     * 編集処理
     *
     * @param TodoAddRequest $request
     * @return void
     */
    public function todoEdit(TodoAddRequest $request)
    {
        logger($request);
        // 登録処理
        $response = $this->todo->updateData($request);

        return $response;
    }

    /**
     * 削除処理
     *
     * @param TodoAddRequest $request
     * @return void
     */
    public function todoDelete($id)
    {
        logger($id);

        // $response = $this->todo->deleteData($id);

        // return $response;
    }
}
