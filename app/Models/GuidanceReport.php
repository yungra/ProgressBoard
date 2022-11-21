<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidanceReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'timetable_id',
        'subject_id',
        'report',
    ];
}
