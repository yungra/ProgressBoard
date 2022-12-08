<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    public function student(){
        return $this->hasOne(Student::class, 'id');
    }

    public function teacher(){
        return $this->hasOne(Teacher::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    protected $fillable = [
        'student_id',
        'teacher_id'
    ];
}
