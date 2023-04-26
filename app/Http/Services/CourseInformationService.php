<?php

namespace App\Http\Services;

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

        foreach ($courseDates as $date) {
            $courseInformation->course_id = $courseId[0];
            $courseInformation->day = $date['day'];
            $courseInformation->time = $date['time'];
            $courseInformation->save();
        }
    }

    public function storeCourseSkills($courseSkills, $courseId)
    {
        $courseInformation = new CourseInformation;

        foreach ($courseSkills as $skill) {
            $courseInformation->course_id = $courseId[0];
            $courseInformation->skill = $skill;
            $courseInformation->save();
        }
    }

    public function storeInstructors($courseInstructors, $courseId)
    {
        $courseInformation = new CourseInformation;

        foreach ($courseInstructors as $instructor) {
            $courseInformation->course_id = $courseId[0];
            $courseInformation->text = $instructor['instructor-descr-body'];
            $courseInformation->image = $instructor['img'];
            $courseInformation->save();
        }
    }

    public function storeSyllabuses($courseSyllabuses, $courseId)
    {
        $courseInformation = new CourseInformation;

        foreach ($courseSyllabuses as $syllabus) {
            $courseInformation->course_id = $courseId[0];
            $courseInformation->name = $syllabus['syllabus-name'];
            $courseInformation->text = $syllabus['syllabus-descr-body'];
            $courseInformation->save();
        }
    }
}
