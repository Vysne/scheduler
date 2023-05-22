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
        }
    }

    public function storeCourseSkills($courseSkills, $courseId)
    {
        $courseInformation = new CourseInformation;

        foreach ($courseSkills as $key => $skill) {

            $skill['course_id'] = $courseId[0];
            $skill['key'] = $key;

            $courseInformation::insert($skill);
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
        }
    }

    public function storeSyllabuses($courseSyllabuses, $courseId)
    {
        $courseInformation = new CourseInformation;

        foreach ($courseSyllabuses as $key => $syllabus) {

            $syllabus['course_id'] = $courseId[0];
            $syllabus['key'] = $key;

            $courseInformation::insert($syllabus);
        }
    }

    public function updateCourseDates($courseDates, $courseId)
    {
        if ($courseDates !== null) {
            foreach($courseDates as $key => $date) {
                CourseInformation::updateOrCreate(
                    [
                        'course_id' => $courseId,
                        'key' => $key
                    ],
                    [
                        'course_id' => $courseId,
                        'day' => $date['day'],
                        'time' => $date['time']
                    ]
                );
            }
        }
    }

    public function updateCourseSkills($courseSkills, $courseId)
    {
        if ($courseSkills !== null) {
            foreach($courseSkills as $key => $skill) {
                CourseInformation::updateOrCreate(
                    [
                        'course_id' => $courseId,
                        'key' => $key
                    ],
                    [
                        'course_id' => $courseId,
                        'skill' => $skill
                    ]
                );
            }
        }
    }

    public function updateCourseInstructors($courseInstructors, $courseId, $request)
    {
        if ($courseInstructors !== null) {
            foreach($courseInstructors as $key => $instructor) {
                $upload = $request->file('instructor.' . $key . '.img');

                if ($upload != null) {
                    $filePath = $upload->store('public');
                    $file = str_replace('public', 'storage', $filePath);
                } else {
                    $file = $instructor['instructor-image'];
                }

                CourseInformation::updateOrCreate(
                    [
                        'course_id' => $courseId,
                        'key' => $key,
                    ],
                    [
                        'instructor-descr-body' => $instructor['instructor-descr-body'],
                        'element-name' => $instructor['element-name'],
                        'img' => $file,
                        'course_id' => $courseId,
                    ]
                );
            }
        }
    }

    public function updateCourseSyllabuses($courseSyllabuses, $courseId)
    {
        if ($courseSyllabuses !== null) {
            foreach($courseSyllabuses as $key => $syllabus) {
                CourseInformation::updateOrCreate(
                    [
                        'course_id' => $courseId,
                        'key' => $key
                    ],
                    [
                        'course_id' => $courseId,
                        'syllabus-name' => $syllabus['syllabus-name'],
                        'element-name' => $syllabus['element-name'],
                        'syllabus-descr-body' => $syllabus['syllabus-descr-body']
                    ]
                );
            }
        }
    }
}
