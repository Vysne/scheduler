<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Http\Services\CourseInformationService;

class CourseController extends Controller
{
    public function index()
    {
        return view('course-create-page');
    }

    public function create(Request $request)
    {
        $course = new Course;
        $courseInfoService = new CourseInformationService();

        $courseId = $courseInfoService->createCourseId();

        $course->id = $courseId[0];
        $course->name = request('course-name');
        $course->author = Auth::user()->getAuthIdentifier();
        $course->image = $request->file('course-img')->store('public');
        $course->type = request('course-type');
        $course->save();

        $courseInfoService->storeCourseDates(request('date'), $courseId);
        $courseInfoService->storeCourseSkills(request('skill'), $courseId);
        $courseInfoService->storeInstructors(request('instructor'), $courseId);
        $courseInfoService->storeSyllabuses(request('syllabus'), $courseId);
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
