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


class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers = Teacher::with('address.prefecture', 'university')
        ->searchKeyword($request->keyword)
        ->paginate($request->pagination ?? 2);
        return view('teacher.teachers.index', compact('teachers'));
    }


}
