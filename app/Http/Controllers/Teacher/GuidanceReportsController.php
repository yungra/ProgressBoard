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
        $id = Auth::id();
        $reports = GuidanceReport::where('teacher_id', '=', $id)
            ->searchDate($request->date)
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
