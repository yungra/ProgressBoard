<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $notices = Notice::where('is_student', 0)->paginate($request->pagination ?? 2);
        return view('teacher.notices.index', compact('notices'));
    }

    public function show($id)
    {
        $notice = Notice::where('id', $id)->first();
        return view('teacher.notices.show', compact('notice'));
    }
}
