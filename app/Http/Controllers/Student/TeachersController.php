<?php

namespace App\Http\Controllers\Student;

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
        $this->middleware('auth:students');
    }

    public function index()
    {
        $teachers = Teacher::with('address.prefecture', 'university')->paginate(3);
        // dd($teachers);
        return view('student.teachers.index', compact('teachers'));
    }

}
