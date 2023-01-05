<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatRoom;
use App\Models\Teacher;
use App\Models\Message;
use App\Models\Student;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $id = Auth::id();
    //     $chat_rooms = ChatRoom::where('teacher_id', '=', $id)
    //     ->with('student', 'messages')
    //     ->paginate(3);
    //     return view('teacher.chats.index', compact('chat_rooms'));
    // }

    public function show($id)
    {
        $chat_room = ChatRoom::where('student_id', '=', $id)
            ->where('teacher_id', '=', Auth::id())
            ->with('messages', 'student', 'teacher')
            ->first();
        // dd($chat_room);
        // チャットルームが既に存在してるか判定
        if ($chat_room) {
            // dd($chat_room->messages);
        } else {
            $chat_room = ChatRoom::create([
                'student_id' => $id,
                'teacher_id' => Auth::id(),
            ]);
        }
        // $student = Student::where('id', '=', $id)->first();
        $messages = Message::get();
        return view('teacher.chats.show', compact('chat_room'));
    }

    public function send(Request $request, $id)
    {
        $chat_room = ChatRoom::where('student_id', '=', $id)
            ->where('teacher_id', '=', Auth::id())->first();
        $chat_room_id = $chat_room->id;

        $content = $request->message;

        Message::create([
            'chat_room_id' => $chat_room_id,
            'is_student' => 0,
            'content' => $content,
        ]);
        return redirect()->route('teacher.chat.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('teacher.chats.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
