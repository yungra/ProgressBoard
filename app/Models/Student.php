<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    public function address()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function school()
    {
        return $this->belongsTo(Shool::class, 'school_id');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'city_id',
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
