<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;

    public function address()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function university()
    {
        return $this->belongsTo(School::class, 'university_id');
    }

    protected $fillable = [
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
