<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TodoController extends Controller
{
    public function show()
    {
        return view('student.todo.show');
    }
}
