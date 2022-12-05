<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    // protected $table = 'your_table';

    public function guidanceReport(){
        return $this->hasMany(GuidanceReport::class);
    }

    protected $fillable = [
        'name',
        'day'
    ];
}
