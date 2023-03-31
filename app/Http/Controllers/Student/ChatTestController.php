<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Events\ChatAdded;
use App\Http\Resources\ChatTestResource;
use App\Models\ChatMessageTest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatTestController extends Controller
{
    public function index()
    {
        // return Inertia::render('Chat/Index');
        return view('student.chat.show', ['data' => 1]);
        // return route('student.chattest');
    }

    public function list()
    {
        // $chat_messages = ChatMessage::with('user')
        //     ->limit(10) // 10件だけ
        //     ->latest()  // 新着順
        //     ->get();

        $chat_messages_test = ChatMessageTest::limit(10) // 10件だけ
            ->latest()  // 新着順
            ->get();

        return ChatTestResource::collection($chat_messages_test);
    }

    public function store(Request $request)
    {
        // 注： バリデーションは省略してます

        $chat_messages_test = new ChatMessageTest();
        // $chat_messages_test->user_id = auth()->id();
        $chat_messages_test->message = $request->message;
        $chat_messages_test->save();

        ChatAdded::dispatch($chat_messages_test); // ブロードキャストを実行

        return to_route('student.chat.index'); // リダイレクト
    }
}
