<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Todo extends Model
{
    use HasFactory;

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
                'user_id' => $addTodoData['user_id'],
                'postal_code' => $addTodoData['postal_code'],
                'pref_id' => $addTodoData['pref_id'],
            ]);

            DB::commit();
        } catch (\Throwable$th) {
            DB::rollBack();
        }
    }

}
