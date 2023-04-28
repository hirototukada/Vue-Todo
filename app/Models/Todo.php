<?php

namespace App\Models;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'task',
        'content',
        'memo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * データ取得処理
     *
     * @return array $todoParam
     */
    public function getData($page, $userId): array
    {
        logger('取得処理始まり');
        logger($page);

        $test   = Todo::find(3);
        $sample = $test->user;
        logger('取得');
        logger($sample);

        $pages = $this->countReplacement($page);

        $todoParam = Todo::offset($pages['start'])->limit($pages['next'])->get()->toArray();

        return $todoParam;
    }

    /**
     * データ取得処理
     *
     * @param int $id
     * @return array $todoParam
     */
    public function getEditData($id): array
    {
        logger('編集取得処理スタート');

        $todoParam = Todo::get()->where('id', $id)->first()->toArray();

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

    /**
     *  編集処理
     *
     * @param array $editTodoData
     * @return
     */
    public function updateData($editTodoData)
    {
        $todoData = Todo::where('id', $editTodoData['id'])->first();

        try {
            DB::beginTransaction();

            $todoData->task    = $editTodoData['task'];
            $todoData->content = $editTodoData['content'];
            $todoData->memo    = $editTodoData['memo'];

            $todoData->save();
            DB::commit();
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     *  削除処理
     *
     * @param int $id
     */
    public function deleteData(int $id)
    {
        try {
            DB::beginTransaction();
            Todo::where('id', $id)->delete();
            DB::commit();
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     * ページ数取得用
     *
     * @param [type] $page
     * @return array
     */
    private function countReplacement($page)
    {
        $pages = [];
        $page  = intval($page);
        if ($page == 1) {
            $pages['start'] = $page - 1;
            $pages['next']  = $page * 10;
        } else {
            $math           = $page - 1;
            $pages['start'] = $math * 10;
            $pages['next']  = $page * 10;
        }

        return $pages;
    }
}
