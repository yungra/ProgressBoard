<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB; // QueryBuilder クエリビルダ
use Illuminate\Support\Facades\Hash;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Models\School;
use App\Models\Prefecture;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class MyinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $data = Student::where('id', '=', $id)->with('address.prefecture', 'school', 'desired_school')->get();
        $myinfo = $data[0];
        return view('student.myinfo.index', compact('myinfo'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $prefectures = Prefecture::with('cities')->orderBy('id', 'asc')->get();
        $schools = School::orderBy('id', 'asc')->get();
        return view('student.myinfo.edit', compact('student', 'prefectures', 'schools'));
    }

    public function update(Request $request, $id)
    {
        // dd('test');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Student::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        
        try{
            DB::transaction(function () use($request, $id) {
               
                    $student = Student::findOrFail($id);
                    $student->name = $request->name;
                    $student->email = $request->email;
                    $student->city_id = $request->address;
                    $student->university_id = $request->university;
                    $student->password = Hash::make($request->password);
                    $student->save();
        });
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
        return redirect()->route('student.myinfo.index');
    }

}
