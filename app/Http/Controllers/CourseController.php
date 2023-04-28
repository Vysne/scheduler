<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Http\Services\CourseInformationService;

class CourseController extends Controller
{
    public function index()
    {
        return view('course-create-page');
    }

    public function show($courseId)
    {
        return view('course-edit-page', ['course' => $this->getSelectedCourse($courseId)]);
    }

    public function create(Request $request)
    {
        $course = new Course;
        $courseInfoService = new CourseInformationService;

        $courseId = $courseInfoService->createCourseId();

        $course->id = $courseId[0];
        $course->course_name = request('course-name');
        $course->author = Auth::user()->getAuthIdentifier();
        $course->image = $request->file('course-img')->store('public');
        $course->type = request('course-type');
        $course->course_descr_body = request('course-descr-body');
        $course->save();

        $courseInfoService->storeCourseDates(request('date'), $courseId);
        $courseInfoService->storeCourseSkills(request('skill'), $courseId);
        $courseInfoService->storeInstructors(request('instructor'), $courseId);
        $courseInfoService->storeSyllabuses(request('syllabus'), $courseId);

        return redirect('dashboard');
    }

    public function update($courseId)
    {
        var_dump($courseId);
    }

    public function remove()
    {
        return;
    }

    private function getSelectedCourse($courseId)
    {
        $course = DB::table('courses')
            ->select('courses.id', 'courses.course_name', 'courses.image', 'courses.type', 'courses.course_descr_body')
            ->where('courses.id', '=', $courseId)
            ->get()
            ->toArray();

        $courseDates = DB::table('course_information')
            ->select('course_information.key', 'course_information.day', 'course_information.time')
            ->where('course_information.course_id', '=', $courseId)
            ->whereNotNull(['course_information.key', 'course_information.day', 'course_information.time'])
            ->get()
            ->toArray();

        $courseSkills = DB::table('course_information')
            ->select('course_information.key', 'course_information.skill')
            ->where('course_information.course_id', '=', $courseId)
            ->whereNotNull('course_information.skill')
            ->get()
            ->toArray();

        $courseInstructors = DB::table('course_information')
            ->select('course_information.key', 'course_information.instructor-descr-body', 'course_information.img')
            ->where('course_information.course_id', '=', $courseId)
            ->whereNotNull(['course_information.key', 'course_information.instructor-descr-body', 'course_information.img'])
            ->get()
            ->toArray();

        $courseSyllabuses['course-syllabuses'] = DB::table('course_information')
            ->select('course_information.key', 'course_information.syllabus-name', 'course_information.syllabus-descr-body')
            ->where('course_information.course_id', '=', $courseId)
            ->whereNotNull(['course_information.key', 'course_information.syllabus-name', 'course_information.syllabus-descr-body'])
            ->get()
            ->toArray();

//        $courseData = [
//            'about-course' => $course,
//            'course-dates' => $courseDates,
//            'course-skills' => $courseSkills,
//            'course-instructors' => $courseInstructors,
//            'course-syllabuses' => $courseSyllabuses
//        ];

        $courseData = [
            'about-course' => $course,
            'course-dates' => $courseDates,
            'course-skills' => $courseSkills,
            'course-instructors' => $courseInstructors
//            $courseSyllabuses
        ];

        return json_decode(json_encode($courseData), true);
    }
}
