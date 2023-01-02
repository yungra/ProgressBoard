<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidanceReport extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function timetable()
    {
        return $this->belongsTo(Timetable::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    protected $fillable = [
        'student_id',
        'teacher_id',
        'class_day',
        'timetable_id',
        'subject_id',
        'report',
        'created_at'
    ];

    public function scopeSearchDate($query, $date)
    {
        if(!is_null($date))
        {
           
           $query->where('guidance_reports.class_day', $date);

           return $query;  

        } else {
            return;
        }
    }
}
