<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\CourseInformation;

class CourseInformationService
{
    public function createCourseId()
    {
        $numbers = range(1000, 9999);
        shuffle($numbers);

        return array_slice($numbers, 0, 1);
    }

    public function storeCourseDates($courseDates, $courseId)
    {
        $courseInformation = new CourseInformation;


        foreach ($courseDates as $key => $date) {

            $date['course_id'] = $courseId[0];
            $date['key'] = $key;

            $courseInformation::insert($date);
//            $courseInformation->course_id = $courseId[0];
//            $courseInformation->key = $key;
//            $courseInformation->day = $date['day'];
//            $courseInformation->time = $date['time'];
//            $courseInformation->save();
        }
    }

    public function storeCourseSkills($courseSkills, $courseId)
    {
        $courseInformation = new CourseInformation;

        foreach ($courseSkills as $key => $skill) {

            $skill['course_id'] = $courseId[0];
            $skill['key'] = $key;

            $courseInformation::insert($skill);
//            $courseInformation->course_id = $courseId[0];
//            $courseInformation->skill = $skill;
//            $courseInformation->save();
        }
    }

    public function storeInstructors($courseInstructors, $courseId, $request)
    {
        $courseInformation = new CourseInformation;

        foreach ($courseInstructors as $key => $instructor) {

            $instructor['course_id'] = $courseId[0];
            $instructor['key'] = $key;
            $filePath = $request->file('instructor.' . $instructor['key'] . '.img')->store('public');
            $instructor['img'] = str_replace('public', 'storage', $filePath);

            $courseInformation::insert($instructor);
//            $courseInformation->course_id = $courseId[0];
//            $courseInformation->text = $instructor['instructor-descr-body'];
//            $courseInformation->image = $instructor['img'];
//            $courseInformation->save();
        }
    }

    public function storeSyllabuses($courseSyllabuses, $courseId)
    {
        $courseInformation = new CourseInformation;

        foreach ($courseSyllabuses as $key => $syllabus) {

            $syllabus['course_id'] = $courseId[0];
            $syllabus['key'] = $key;

            $courseInformation::insert($syllabus);
//            $courseInformation->course_id = $courseId[0];
//            $courseInformation->name = $syllabus['syllabus-name'];
//            $courseInformation->text = $syllabus['syllabus-descr-body'];
//            $courseInformation->save();
        }
    }

//    public function u
}
