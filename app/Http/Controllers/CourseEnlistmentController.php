<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\EnlistmentService;

class CourseEnlistmentController extends Controller
{
    public function index($courseId)
    {
        $enlistmentService = new EnlistmentService;

        return view('course-members-page', ['enlistments' => $enlistmentService->getCourseEnlistments($courseId), 'members' => $enlistmentService->getCourseMembers($courseId)]);
    }
}
