<?php

namespace App\Http\Controllers\Teacher;

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
use App\Models\GuidanceReport;


class QuestionnaireController extends Controller
{

    public function show($report_id)
    {
        $questionnaire = Questionnaire::where('guidance_report_id', '=', $report_id)
            ->first();
        $report = GuidanceReport::where('id', '=', $report_id)
            ->first();

        return view('teacher.questionnaire.show', compact('report_id', 'questionnaire', 'report'));
    }
}
