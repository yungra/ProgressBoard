<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function chat_room()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    protected $fillable = [
        'room_id',
        'is_student',
        'content',
    ];
}
