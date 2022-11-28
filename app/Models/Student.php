<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    public function prefecture(){
        return $this->belongsTo(Prefecture::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'prefecture_id',
        'region_id',
        'school_id',
        'desired_school_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
