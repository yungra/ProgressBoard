<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    public function students(){
        return $this->hasMany(Student::class);
    }

    protected $fillable = [
        'name'
    ];
}
