<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\CourseInformation;
use App\Http\Services\CourseInformationService;
use App\Http\Services\EnlistmentService;

class CourseController extends Controller
{
    public function index()
    {
        return view('course-create-page');
    }

    public function show($courseId)
    {
        $enlistmentService = new EnlistmentService;

        return view('course-edit-page', ['course' => $this->getSelectedCourse($courseId), 'availability' => $enlistmentService->checkEnlistment()]);
    }

    public function create(Request $request)
    {
        $course = new Course;
        $courseInfoService = new CourseInformationService;

        $courseId = $courseInfoService->createCourseId();

        $course->id = $courseId[0];
        $course->course_name = request('course-name');
        $course->author = Auth::user()->getAuthIdentifier();
        $filePath = $request->file('course-img')->store('public');
        $course->image = str_replace('public', 'storage', $filePath);
        $course->type = request('course-type');
        $course->requirements = request('course-requirements');
        $course->course_descr_body = request('course-descr-body');
        $course->save();

        $courseInfoService->storeCourseDates(request('date'), $courseId);
        $courseInfoService->storeCourseSkills(request('skill'), $courseId);
        $courseInfoService->storeInstructors(request('instructor'), $courseId, $request);
        $courseInfoService->storeSyllabuses(request('syllabus'), $courseId);

        return redirect('dashboard');
    }

    public function update(Request $request)
    {
        $courseInfoService = new CourseInformationService;

        if ($request->file('course-img')) {
            $filePath = $request->file('course-img')->store('public');
            $file = str_replace('public', 'storage', $filePath);
        } else {
            $file = request('course-image');
        }

        Course::where('id', request('course_id'))
            ->update([
                'course_name' => request('course-name'),
                'image' => $file,
                'type' => request('course-type'),
                'requirements' => request('course-requirements'),
                'course_descr_body' => request('course-descr-body'),
                'visible' => 0
            ]);

        $courseInfoService->updateCourseDates(request('date'), request('course_id'));
        $courseInfoService->updateCourseSkills(request('skill'), request('course_id'));
        $courseInfoService->updateCourseInstructors(request('instructor'), request('course_id'), $request);
        $courseInfoService->updateCourseSyllabuses(request('syllabus'), request('course_id'));

        return redirect('dashboard');
    }

    public function remove()
    {
        CourseInformation::where('id', request('conditionId'))
            ->delete();

        return redirect()->back();
    }

    public function getSelectedCourse($courseId)
    {
        $course = DB::table('courses')
            ->select('courses.id', 'courses.course_name', 'courses.author', 'courses.image', 'courses.type', 'courses.requirements', 'courses.course_descr_body')
            ->where('courses.id', '=', $courseId)
            ->get()
            ->toArray();

        $courseDates = DB::table('course_information')
            ->select('course_information.id', 'course_information.key', 'course_information.day', 'course_information.time')
            ->where('course_information.course_id', '=', $courseId)
            ->whereNotNull(['course_information.key', 'course_information.day', 'course_information.time'])
            ->get()
            ->toArray();

        $courseSkills = DB::table('course_information')
            ->select('course_information.id', 'course_information.key', 'course_information.skill')
            ->where('course_information.course_id', '=', $courseId)
            ->whereNotNull('course_information.skill')
            ->get()
            ->toArray();

        $courseInstructors = DB::table('course_information')
            ->select('course_information.id', 'course_information.key', 'course_information.element-name', 'course_information.instructor-descr-body', 'course_information.img')
            ->where('course_information.course_id', '=', $courseId)
            ->whereNotNull(['course_information.key', 'course_information.element-name', 'course_information.instructor-descr-body', 'course_information.img'])
            ->get()
            ->toArray();

        $courseSyllabuses = DB::table('course_information')
            ->select('course_information.id', 'course_information.key', 'course_information.syllabus-name', 'course_information.element-name', 'course_information.syllabus-descr-body')
            ->where('course_information.course_id', '=', $courseId)
            ->whereNotNull(['course_information.key', 'course_information.syllabus-name', 'course_information.element-name', 'course_information.syllabus-descr-body'])
            ->get()
            ->toArray();

        $courseData = [
            'about-course' => $course,
            'course-dates' => $courseDates,
            'course-skills' => $courseSkills,
            'course-instructors' => $courseInstructors,
            'course-syllabuses' => $courseSyllabuses
        ];

        return json_decode(json_encode($courseData), true);
    }
}
