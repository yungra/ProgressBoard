<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Jobs\SendNoticeMail;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notices = Notice::paginate($request->pagination ?? 2);
        return view('admin.notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = $request->subject;
        $content = $request->content;
        $is_student = $request->is_student;

        // //同期
        // //生徒向けの場合
        // if ($request->is_student) {
        //     $students_email = Student::where('deleted_at', null)->select('email')->get();
        //     // foreach ($students_email as $smail) {
        //     //     Mail::to($smail)
        //     //         ->send(new TestMail($subject, $content));
        //     // }
        //     Mail::to($students_email[0])
        //         ->send(new TestMail($subject, $content));
        // } else {
        //     //講師向けの場合
        //     $teachers_email = Teacher::where('deleted_at', null)->select('email')->get();
        //     foreach ($teachers_email as $tmail) {
        //         Mail::to($tmail)
        //             ->send(new TestMail($is_student, $subject, $content));
        //     }
        // }

        //非同期に送信
        SendNoticeMail::dispatch($is_student, $subject, $content);
        // dd('メール送信完了');

        $request->validate([
            // 'class_day' => ['required', 'string', 'max:255'],
            // 'report' => ['required', 'string', 'max:255'],
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Teacher::class],
            // 'password' => ['required', 'confirmed', 'min:8'],
        ]);

        Notice::create([
            'is_student' => $is_student,
            'subject' => $subject,
            'content' => $content,
        ]);

        return redirect()->route('admin.notice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        $notice = Notice::where('id', $notice->id)->first();
        return view('admin.notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        //
    }
}
