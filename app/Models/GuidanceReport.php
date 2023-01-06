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

    public function questionnaire()
    {
        return $this->hasOne(Questionnaire::class);
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

    public function scopeSearchKeywordId($query, $keyword_id)
    {
        if (!is_null($keyword_id)) {

            //コントローラから渡されたIDに対応するカラムを検索
            foreach ($keyword_id as $id) {
                $query->where('guidance_reports.student_id', $id);
            }

            return $query;
        } else {
            return;
        }
    }

    public function scopeSearchDate($query, $date)
    {
        if (!is_null($date)) {

            $query->where('guidance_reports.class_day', $date);

            return $query;
        } else {
            return;
        }
    }
}
