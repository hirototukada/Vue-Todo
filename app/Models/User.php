<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // パスワードハッシュ化用
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getPasswordAttribute($value)
    {
        return $value;
    }

    /**
     * 登録処理
     *
     * @param array $userParam
     * @return int $id
     */
    public function store($userParam)
    {
        try {
            DB::beginTransaction();

            User::create([
                'name' => $userParam['name'],
                'email' => $userParam['email'],
                'password' => $userParam['password'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     * emailからユーザー情報取得処理
     *
     * @param string $email
     * @return array $userParam
     */
    public function getData(string $email)
    {
        $userParam = User::where('email', $email)->first();

        return $userParam;
    }
}
