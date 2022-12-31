<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB; // QueryBuilder クエリビルダ
use Illuminate\Support\Facades\Hash;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Models\School;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;


class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('address.prefecture', 'school', 'desired_school', 'guidance_reports')
        ->paginate(3);
        // dd($students);
        $teacher_id = Auth::id();
        $true = array();
        $false = array();
        // 生徒を一人ひとり見ていく
        foreach($students as $student)
        {
            $flag = false;
            // 生徒に紐づく指導報告書を一つひとつ見ていく
            foreach($student->guidance_reports as $s)
            {
                // 指導報告書の中で、ログイン講師と紐づくものがあるか
                if($s->teacher_id === $teacher_id)
                {
                    array_push($true, $student);
                    $flag = true;
                    break;
                }
            }
            if(!$flag){
                array_push($false, $student);
            }
        }
        // dd($false);
        return view('teacher.students.index', compact('students', 'true', 'false'));
    }


}
