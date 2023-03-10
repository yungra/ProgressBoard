<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Events\ChatAdded;
use App\Http\Resources\ChatResource;
use App\Models\Message;
use App\Models\ChatRoom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class RealtimeChatController extends Controller
{
    public function index($id)
    {
        $chat_room = ChatRoom::where('student_id', '=', $id)
            ->where('teacher_id', '=', Auth::id())
            // ->with('messages', 'student', 'teacher')
            ->first();

        // チャットルームが既に存在してるか判定
        if ($chat_room) {
            // 存在する場合はスルー;
        } else {
            $chat_room = ChatRoom::create([
                'teacher_id' => $id,
                'student_id' => Auth::id(),
            ]);
        }

        // return Inertia::render('Chat/Index');
        return view('teacher.realtime_chat.show', ['chat_room' => $chat_room]);
        // return route('student.chattest');
    }

    public function list($id)
    {
        // $chat_messages = ChatMessage::with('user')
        //     ->limit(10) // 10件だけ
        //     ->latest()  // 新着順
        //     ->get();

        $messages = Message::where('chat_room_id', '=', $id)
            ->with('chat_room.student', 'chat_room.teacher')
            // ->with('student', 'teacher')
            ->limit(10) // 10件だけ
            ->latest()  // 新着順
            ->get();

        $student = $messages[0]->chat_room->student->name;
        $teacher = $messages[0]->chat_room->teacher->name;

        // return ChatResource::collection($messages);
        return collect([$messages, $student, $teacher]);
    }

    public function store(Request $request)
    {
        // 注： バリデーションは省略してます

        $chat_message = new Message();
        // $chat_message->user_id = auth()->id();
        $chat_message->chat_room_id = $request->chat_room_id;
        $chat_message->is_student = $request->is_student;
        $chat_message->content = $request->content;
        $chat_message->save();

        ChatAdded::dispatch($chat_message); // ブロードキャストを実行

        // return to_route('student.realtime_chat.index', ['id' => $request->chat_room_id]); // リダイレクト
        return redirect('teacher.realtime_chat.index', ['id' => $request->chat_room_id]); // リダイレクト
    }
}
