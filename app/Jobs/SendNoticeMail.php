<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Student;
use App\Models\Teacher;

class SendNoticeMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $is_student;
    public $subject;
    public $content;

    public function __construct($is_student, $subject, $content)
    {
        $this->is_student = $is_student;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //生徒向けの場合
        if ($this->is_student) {
            $students_email = Student::where('deleted_at', null)->select('email')->get();
            foreach ($students_email as $smail) {
                Mail::to($smail)
                    ->send(new TestMail($this->subject, $this->content));
            }
            // Mail::to($students_email[0])
            //     ->send(new TestMail($this->subject, $this->content));
        } else {
            //講師向けの場合
            $teachers_email = Teacher::where('deleted_at', null)->select('email')->get();
            foreach ($teachers_email as $tmail) {
                Mail::to($tmail)
                    ->send(new TestMail($this->subject, $this->content));
            }
        }
    }
}
