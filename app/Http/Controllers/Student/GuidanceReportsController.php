<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\GuidanceReport;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\School;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;

class GuidanceReportsController extends Controller
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
        $id = auth()->id();
        $reports = GuidanceReport::where('student_id' ,$id)
        ->searchDate($request->date)
        ->with('student', 'teacher', 'timetable', 'subject')
        ->paginate($request->pagination ?? 2);
        return view('student.reports.index', compact('reports'));
    }

    public function show($id)
    {
        $report = GuidanceReport::with('teacher', 'timetable', 'subject')->findOrFail($id);
        // dd($report);
        return view('student.reports.show', compact('report'));
    }

}
