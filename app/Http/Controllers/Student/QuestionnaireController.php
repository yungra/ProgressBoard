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
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{

    public function edit($id)
    {
        // dd('edit');
        $questionnaire = Questionnaire::where('guidance_report_id', '=', $id)
            ->get();

        // 空なら
        if ($questionnaire->isEmpty()) {
            $questionnaire = new Questionnaire();
            $questionnaire->fill([
                'guidance_report_id' => $id,
                'comprehension' => '1',
                'speed' => '1',
                'satisfaction' => '1',
            ]);
            // データベースに値をinsert
            $questionnaire->save();
            // dd($questionnaire);
            return view('student.questionnaire.edit', compact('id', 'questionnaire'));
        } else {
            $questionnaire = $questionnaire[0];
            return view('student.questionnaire.edit', compact('id', 'questionnaire'));
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Teacher::class],
            // 'password' => ['required', 'confirmed', 'min:8'],
        ]);

        try {
            DB::transaction(function () use ($request, $id) {

                $questionnaire = Questionnaire::findOrFail($id);
                $questionnaire->guidance_report_id = $request->id;
                $questionnaire->comprehension = $request->comprehension;
                $questionnaire->speed = $request->speed;
                $questionnaire->satisfaction = $request->satisfaction;
                $questionnaire->free = $request->free;
                $questionnaire->save();
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }
        return redirect()->route('student.questionnaire.edit', ['id' => $id]);
    }
}
