<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatRoom;
use App\Models\Teacher;
use App\Models\Message;

class ChatController extends Controller
{

    public function show($id)
    {
        $chat_room = ChatRoom::where('teacher_id', '=', $id)
            ->where('student_id', '=', Auth::id())
            ->with('messages', 'student', 'teacher')
            ->first();

        // チャットルームが既に存在してるか判定
        if ($chat_room) {
            // dd($chat_room->messages);
        } else {
            $chat_room = ChatRoom::create([
                'teacher_id' => $id,
                'student_id' => Auth::id(),
            ]);
        }


        $teacher = Teacher::where('id', '=', $id)->first();
        $messages = Message::get();
        return view('student.chats.show', compact('chat_room'));
    }

    public function send(Request $request, $id)
    {
        $chat_room = ChatRoom::where('teacher_id', '=', $id)
            ->where('student_id', '=', Auth::id())->first();
        $chat_room_id = $chat_room->id;

        $content = $request->message;

        Message::create([
            'chat_room_id' => $chat_room_id,
            'is_student' => 1,
            'content' => $content,
        ]);
        return redirect()->route('student.chat.show', $id);
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
