<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    
    public function cities(){
        return $this->hasMany(City::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }

    protected $fillable = [
        'name'
    ];
}
