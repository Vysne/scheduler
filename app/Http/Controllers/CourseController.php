<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseInformation;

class CourseController extends Controller
{
    public function index()
    {
        return view('course-create-page');
    }

    public function create(Request $request)
    {
//        $course = new Course;
//        $course->name = $request->
        dd($request->all());
    }

    public function update()
    {
        return;
    }

    public function remove()
    {
        return;
    }
}
