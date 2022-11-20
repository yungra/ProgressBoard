<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    //ホワイトリスト。指定したカラムに対してのみ、create()やupdate(),fill()が可能になる
    //guardedだと、ブラックリスト。
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    //指定した項目が常に取得対象外となる
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //データアクセス時に型変換する
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
