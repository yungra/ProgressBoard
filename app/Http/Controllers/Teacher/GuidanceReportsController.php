<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\GuidanceReport;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use Illuminate\Support\Facades\DB;

class GuidanceReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //ログインしてる講師のIDを取得
        $id = Auth::id();

        //検索欄に入力された「生徒名」から、該当する指導報告書を取得したい。
        //ただ今回、指導報告書テーブルには「student_id」しかなく、生徒名でのカラムがない。
        //そのためまずは生徒テーブルから生徒名で検索キーワードに該当する生徒を求め、そこからIDを取り出して$keyword_idにまとめる
        //後ほどこの$keyword_idを使い、guidance_reportsテーブルから生徒IDで該当する指導報告書を取得する

        //検索欄に入力されたキーワードから、生徒を検索
        $students = Student::searchKeyword($request->keyword)->get();
        //配列を用意し、入力されたキーワードに対応する生徒のIDを入れていく
        $keyword_id = array();
        foreach ($students as $student) {
            array_push($keyword_id, $student->id);
        }

        //作成した$keyword_idを引数として、searchKeywordIdメソッドを使用
        $reports = GuidanceReport::where('teacher_id', '=', $id) //ログインしてる講師に対応する条件
            ->searchKeywordId($keyword_id) //検索した生徒に対応するという条件。Models/GuidanceReportのsearchKeywordIdメソッドを使用
            ->searchDate($request->date) //検索して日付に対応するという条件。Models/GuidanceReportのsearchDateメソッドを使用
            ->with('student', 'timetable', 'subject', 'questionnaire')
            ->paginate($request->pagination ?? 2);

        //↓whereHasを使うなら、以下でできそう

        // $reports = GuidanceReport::where('teacher_id', '=', $id)
        //     ->whereHas('student', function ($query) use ($keyword_id) {
        //         foreach ($keyword_id as $word) {
        //             $query->where('student_id', '=', $word);
        //         }
        //     })
        //     ->searchDate($request->date) //検索して日付に対応するという条件。Models/GuidanceReportのsearchDateメソッドを使用
        //     ->with('student', 'timetable', 'subject', 'questionnaire')
        //     ->paginate($request->pagination ?? 2);

        return view('teacher.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::orderBy('id', 'asc')->get();
        $timetables = Timetable::orderBy('id', 'asc')->get();
        $subjects = Subject::orderBy('id', 'asc')->get();
        return view('teacher.reports.create', compact('students', 'timetables', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Teacher::class],
        //     'password' => ['required', 'confirmed', 'min:8'],
        // ]);

        GuidanceReport::create([
            'student_id' => $request->student_id,
            'class_day' => $request->class_day,
            'timetable_id' => $request->timetable,
            'subject_id' => $request->subject,
            'report' => $request->report,
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->route('teacher.reports.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = GuidanceReport::with('student', 'timetable', 'subject')->findOrFail($id);
        // dd($report);
        return view('teacher.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = GuidanceReport::findOrFail($id);
        $students = Student::orderBy('id', 'asc')->get();
        $teachers = Teacher::orderBy('id', 'asc')->get();
        $timetables = Timetable::orderBy('id', 'asc')->get();
        $subjects = Subject::orderBy('id', 'asc')->get();
        return view('teacher.reports.edit', compact('report', 'students', 'timetables', 'subjects', 'teachers'));
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
        $request->validate([
            'report' => ['required', 'string'],
        ]);

        try {
            DB::transaction(function () use ($request, $id) {

                $report = GuidanceReport::findOrFail($id);
                $report->student_id = $request->student;
                $report->class_day = $request->class_day;
                $report->timetable_id = $request->timetable;
                $report->subject_id = $request->subject;
                $report->teacher_id = $request->teacher;
                $report->report = $request->report;
                $report->save();
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }
        return redirect()->route('teacher.reports.index');
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
