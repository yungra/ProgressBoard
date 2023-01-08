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
        'student_name',
        'teacher_id',
        'teacher_name',
        'class_day',
        'timetable_id',
        'subject_id',
        'report',
        'created_at'
    ];

    public function scopeSearchStudent($query, $student_name)
    {
        if (!is_null($student_name)) {
            //全角スペースを半角に
            $spaceConvert = mb_convert_kana($student_name, 's');

            //空白で区切る
            //preg_split(検索するパターン,入力文字列,文字列を返す制限,フラグ)
            //PREG_SPLIT_NO_EMPTY→空文字列でないものが返される
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);
            //             「/（スラッシュ）」は、「正規表現」では、特に意味を持っていません。
            // 「正規表現」のコード・パターンの前後において、明確化する「デリミタ」として使わている。
            // 「デリミタ（Delimiter）」とは、「正規表現」のコード・パターンの前後を囲むことで、パターンの範囲を明示する役割をする記号のこと。

            //単語をループで回す
            foreach ($keywords as $word) {
                $query->where('guidance_reports.student_name', 'like', '%' . $word . '%');
            }

            return $query;
        } else {
            return;
        }
    }

    public function scopeSearchTeacher($query, $teacher_name)
    {
        if (!is_null($teacher_name)) {
            //全角スペースを半角に
            $spaceConvert = mb_convert_kana($teacher_name, 's');

            //空白で区切る
            //preg_split(検索するパターン,入力文字列,文字列を返す制限,フラグ)
            //PREG_SPLIT_NO_EMPTY→空文字列でないものが返される
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);
            //             「/（スラッシュ）」は、「正規表現」では、特に意味を持っていません。
            // 「正規表現」のコード・パターンの前後において、明確化する「デリミタ」として使わている。
            // 「デリミタ（Delimiter）」とは、「正規表現」のコード・パターンの前後を囲むことで、パターンの範囲を明示する役割をする記号のこと。

            //単語をループで回す
            foreach ($keywords as $word) {
                $query->where('guidance_reports.teacher_name', 'like', '%' . $word . '%');
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
