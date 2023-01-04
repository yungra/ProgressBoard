<?php

namespace App\Http\Controllers\Student;

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

class MyinfoController extends Controller
{
    public function show()
    {
        $id = Auth::id();
        $data = Student::where('id', '=', $id)->with('address.prefecture', 'school')->get();
        $myinfo = $data[0];
        // dd($myinfo);
        return view('student.myinfo.show', compact('myinfo'));
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Teacher::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        //画像処理
        $img = $request->file('img_path');
        if (isset($img)) {
            $path = $img->store('public');
            if ($path) {
                try {
                    DB::transaction(function () use ($request, $id, $path) {

                        $student = Student::findOrFail($id);
                        $student->img_path = $path;
                        $student->name = $request->name;
                        $student->email = $request->email;
                        $student->city_id = $request->address;
                        $student->school_id = $request->school;
                        $student->desired_school_id = $request->desired_school;
                        $student->password = Hash::make($request->password);
                        $student->save();
                    });
                } catch (Throwable $e) {
                    Log::error($e);
                    throw $e;
                }
            }
        } else {
            try {
                DB::transaction(function () use ($request, $id) {

                    $student = Student::findOrFail($id);
                    $student->name = $request->name;
                    $student->email = $request->email;
                    $student->city_id = $request->address;
                    $student->school_id = $request->school;
                    $student->desired_school_id = $request->desired_school;
                    $student->password = Hash::make($request->password);
                    $student->save();
                });
            } catch (Throwable $e) {
                Log::error($e);
                throw $e;
            }
        }

        return redirect()->route('student.myinfo.show', ['id' => $id]);
    }
}
