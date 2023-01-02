<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
    use HasFactory, SoftDeletes;

    public function address()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function desired_school()
    {
        return $this->belongsTo(School::class, 'desired_school_id');
    }

    public function guidance_reports()
    {
        return $this->hasMany(GuidanceReport::class);
    }

    protected $fillable = [
        'img_path',
        'name',
        'email',
        'city_id',
        'school_id',
        'desired_school_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeSearchKeyword($query, $keyword)
    {
        if(!is_null($keyword))
        {
           //全角スペースを半角に
           $spaceConvert = mb_convert_kana($keyword,'s');

           //空白で区切る
           $keywords = preg_split('/[\s]+/', $spaceConvert,-1,PREG_SPLIT_NO_EMPTY);

           //単語をループで回す
           foreach($keywords as $word)
           {
               $query->where('students.name','like','%'.$word.'%');
           }

           return $query;  

        } else {
            return;
        }
    }
}
