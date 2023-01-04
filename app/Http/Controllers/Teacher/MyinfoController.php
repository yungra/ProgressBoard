<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB; // QueryBuilder クエリビルダ
use Illuminate\Support\Facades\Hash;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Models\School;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;

class MyinfoController extends Controller
{
    public function show($id)
    {
        $id = Auth::id();
        $data = Teacher::where('id', '=', $id)->with('address.prefecture', 'university')->get();
        $myinfo = $data[0];
        // dd($myinfo->address->prefecture);
        return view('teacher.myinfo.show', compact('myinfo'));
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $prefectures = Prefecture::with('cities')->orderBy('id', 'asc')->get();
        $universities = School::orderBy('id', 'asc')->get();
        return view('teacher.myinfo.edit', compact('teacher', 'prefectures', 'universities'));
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

                        $teacher = Teacher::findOrFail($id);
                        $teacher->img_path = $path;
                        $teacher->name = $request->name;
                        $teacher->email = $request->email;
                        $teacher->city_id = $request->address;
                        $teacher->university_id = $request->university;
                        $teacher->password = Hash::make($request->password);
                        $teacher->save();
                    });
                } catch (Throwable $e) {
                    Log::error($e);
                    throw $e;
                }
            }
        } else {

            try {
                DB::transaction(function () use ($request, $id) {

                    $teacher = Teacher::findOrFail($id);
                    $teacher->name = $request->name;
                    $teacher->email = $request->email;
                    $teacher->city_id = $request->address;
                    $teacher->university_id = $request->university;
                    $teacher->password = Hash::make($request->password);
                    $teacher->save();
                });
            } catch (Throwable $e) {
                Log::error($e);
                throw $e;
            }
        }
        return redirect()->route('teacher.myinfo.show', ['id' => $id]);
    }
}
