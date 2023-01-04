<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\GuidanceReport;
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

    public function edit($report_id)
    {
        $flag = false;
        $questionnaire = Questionnaire::where('guidance_report_id', '=', $report_id)
            ->first();
        $report = GuidanceReport::where('id', '=', $report_id)
            ->first();
        // 空なら
        if (empty($questionnaire)) {
            // dd('空だよ');
            $questionnaire = new Questionnaire();
            $questionnaire->fill([
                'guidance_report_id' => $report_id,
                'comprehension' => '1',
                'speed' => '1',
                'satisfaction' => '1',
            ]);
            // データベースに値をinsert
            $questionnaire->save();
            // dd($questionnaire);
            return view('student.questionnaire.edit', compact('report', 'questionnaire', 'flag'));
        } else {
            $flag = true;
            return view('student.questionnaire.edit', compact('report', 'questionnaire', 'flag'));
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Teacher::class],
            // 'password' => ['required', 'confirmed', 'min:8'],
        ]);
        try {
            DB::transaction(function () use ($request, $id) {

                $questionnaire = Questionnaire::findOrFail($id);
                $questionnaire->guidance_report_id = $request->guidance_report_id;
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
        return redirect()->route('student.reports.index');
    }
}
