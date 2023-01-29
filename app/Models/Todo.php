<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'content',
        'memo',
    ];

    /**
     * データ取得処理
     *
     * @param array $addTodoData
     * @return array $todoParam
     */
    public function getData(): array
    {
        logger('取得処理始まり');

        $todoParam = Todo::get()->toArray();
        logger(gettype($todoParam));

        return $todoParam;
    }

    /**
     *  登録処理
     *
     * @param array $addTodoData
     * @return int $id
     */
    public function store($addTodoData)
    {
        logger('testd');
        try {
            DB::beginTransaction();

            Todo::create([
                'task' => $addTodoData['task'],
                'content' => $addTodoData['content'],
                'memo' => $addTodoData['memo'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

}
