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
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;


class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::with('address.prefecture', 'school', 'desired_school', 'guidance_reports')
        ->get();
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
        //コレクション型、ソート済みの生徒データ
        $students = collect(array_merge($true, $false));
        $studentPaginate = new LengthAwarePaginator(
            //1ページに表示するデータ
            $students->forPage($request->page, 3),//forPage→(現在のページ、1ページあたりの件数)
            //全てのページを合わせた全件数
            $students->count(),
            //1ページに表示する数
            3,
            //現在のページ番号
            null,
            //ペジネーション押下時のURL
            ['path' => $request->url()]
        );
        // dd(collect($studentPaginate));
        return view('teacher.students.index', compact('studentPaginate'));
    }


}
