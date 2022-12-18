<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return Inertia::render('Chat/Index');
    }

    public function list()
    {
        $chat_messages = ChatMessage::with('teacher')
            ->limit(10) // 10件だけ
            ->latest()  // 新着順
            ->get();

        return ChatResource::collection($chat_messages);
    }

    public function store(Request $request)
    {
        // 注： バリデーションは省略してます

        $chat_message = new ChatMessage();
        $chat_message->user_id = auth()->id();
        $chat_message->message = $request->message;
        $chat_message->save();

        ChatMessageCreated::dispatch($chat_message); // ブロードキャストを実行

        return to_route('chat.index'); // リダイレクト
    }
}
