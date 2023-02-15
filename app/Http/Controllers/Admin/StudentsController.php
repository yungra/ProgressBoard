<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Prefecture;
use App\Models\School;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $students = Student::with('address.prefecture', 'school', 'desired_school')
            ->searchKeyword($request->keyword)
            ->paginate($request->pagination ?? 2);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prefectures = Prefecture::with('cities')->orderBy('id', 'asc')->get();
        $schools = School::orderBy('id', 'asc')->get();
        return view('admin.students.create', compact('prefectures', 'schools'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Student::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'city_id' => $request->address,
            'school_id' => $request->school,
            'desired_school_id' => $request->desired_school,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $prefectures = Prefecture::with('cities')->orderBy('id', 'asc')->get();
        $schools = School::orderBy('id', 'asc')->get();
        return view('admin.students.edit', compact('student', 'prefectures', 'schools'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Student::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->city_id = $request->address;
        $student->school_id = $request->school;
        $student->desired_school_id = $request->desired_school;
        $student->password = Hash::make($request->password);

        $student->save();
        return redirect()->route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::findOrFail($id)->delete(); //ソフトデリート
        return redirect()->route('admin.students.index');
    }

    public function expiredStudentIndex(Request $request)
    {
        $expiredStudents = Student::onlyTrashed()
            ->searchKeyword($request->keyword)
            ->paginate($request->pagination ?? 2);
        return view('admin.students.expired-students', compact('expiredStudents'));
    }

    public function expiredStudentDestroy($id)
    {
        Student::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.expired-students.index');
    }
}
