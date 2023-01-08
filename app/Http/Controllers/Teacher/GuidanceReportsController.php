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

        $reports = GuidanceReport::where('teacher_id', '=', $id) //ログインしてる講師に対応する条件
            ->searchStudent($request->keyword) //検索した生徒に対応するという条件。Models/GuidanceReportのsearchKeywordIdメソッドを使用
            ->searchDate($request->date) //検索して日付に対応するという条件。Models/GuidanceReportのsearchDateメソッドを使用
            ->with('student', 'timetable', 'subject', 'questionnaire')
            ->paginate($request->pagination ?? 2);

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
        $request->validate([
            'class_day' => ['required', 'string', 'max:255'],
            // 'report' => ['required', 'string', 'max:255'],
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Teacher::class],
            // 'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $student_name = Student::where('id', $request->student_id)->first()->name;

        GuidanceReport::create([
            'student_id' => $request->student_id,
            'student_name' => $student_name,
            'class_day' => $request->class_day,
            'timetable_id' => $request->timetable,
            'subject_id' => $request->subject,
            'report' => $request->report,
            'teacher_id' => Auth::id(),
            'teacher_name' => Auth::user()->name,
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
            // 'report' => ['required', 'string', 'min:255'],
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
