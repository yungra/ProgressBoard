<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\School;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Hash;
class TeachersController extends Controller
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

    public function index()
    {
        $teachers = Teacher::with('address.prefecture', 'university')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prefectures = Prefecture::with('cities')->orderBy('id', 'asc')->get();
        $universities = School::orderBy('id', 'asc')->get();
        return view('admin.teachers.create', compact('prefectures', 'universities'));
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Teacher::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        // dd($request);
        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'city_id' => $request->address,
            'university_id' => $request->university,
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
        $teacher = Teacher::findOrFail($id);
        $prefectures = Prefecture::with('cities')->orderBy('id', 'asc')->get();
        $universities = School::orderBy('id', 'asc')->get();
        return view('admin.teachers.edit', compact('teacher', 'prefectures', 'universities'));
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
        $teacher = Teacher::findOrFail($id);
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->city_id = $request->address;
        $teacher->university_id = $request->university;
        $teacher->password = Hash::make($request->password);

        $teacher->save();
        return redirect()->route('admin.teachers.index');
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
