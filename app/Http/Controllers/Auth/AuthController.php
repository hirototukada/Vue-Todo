<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * 登録処理
     * ファイアーベースでバリデーションしているためバリデーションなし
     *
     * @param array $userParam
     * @return int $id
     */
    public function userStore(array $userParam)
    {
        // 登録処理
        $this->user->store($userParam);
    }
}
