<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Log\Logger;

class AuthController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * 登録処理
     *
     * @param UserRequest $request
     * @return int $id
     */
    public function userEntry(UserRequest $request)
    {
        Logger($request);
        // 登録処理
        $this->user->store($request);
    }
    /**
     * ユーザー情報取得処理
     *
     * @param string $email
     * @return array $userParam
     */
    public function getUserData(string $email)
    {
        Logger('user取得処理開始');
        Logger($email);

        $userParam = $this->user->getData($email);
        Logger($userParam);
        return $userParam;
    }
}
