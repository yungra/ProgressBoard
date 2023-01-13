<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\School;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:students');
    }

    public function index(Request $request)
    {
        $teachers = Teacher::with('address.prefecture', 'university', 'guidance_reports')
            ->searchKeyword($request->keyword)
            ->orderBy('id', 'asc')
            ->get();
        $student_id = Auth::id();
        $target = array();
        $nontarget = array();
        // 講師を一人ひとり見ていく
        foreach ($teachers as $teacher) {
            $flag = false;
            // 講師に紐づく指導報告書を一つひとつ見ていく
            foreach ($teacher->guidance_reports as $t) {
                // 指導報告書の中で、ログイン生徒と紐づくものがあるか
                if ($t->student_id === $student_id) {
                    array_push($target, $teacher);
                    $flag = true;
                    break;
                }
            }
            if (!$flag) {
                array_push($nontarget, $teacher);
            }
        }
        //条件に合うものの件数
        $target_count = count($target);
        //1ページに表示するデータ数
        $num = $request->pagination ?? 2;
        //現在のページ番号
        $page = $request->page ?? 1;
        //コレクション型、ソート済みの生徒データ
        $students = collect(array_merge($target, $nontarget));
        $teacherPaginate = new LengthAwarePaginator(
            //1ページに表示するデータ
            $students->forPage($request->page, $num), //forPage→(現在のページ、1ページあたりの件数)
            //全てのページを合わせた全件数
            $students->count(),
            //1ページに表示する数
            $num,
            //現在のページ番号
            $page,
            //ペジネーション押下時のURL
            ['path' => $request->url()]
        );
        return view('student.teachers.index', compact('teacherPaginate', 'target_count', 'num', 'page'));
    }
}
