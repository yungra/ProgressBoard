<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Authenticatable
{
    use HasFactory, SoftDeletes;

    public function address()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function university()
    {
        return $this->belongsTo(School::class, 'university_id');
    }

    protected $fillable = [
        'img_path',
        'name',
        'email',
        'password',
        'city_id',
        'university_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
