<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\UserInformationService;

class DashboardTableService
{
    public function showCreatedCourses()
    {
        $userId = Auth::user()->getAuthIdentifier();

        $this->generateDefaultProfileInfo($userId);

        $courses = DB::table('courses')
            ->select('id', 'course_name', 'image', 'type', 'rating', 'visible')
            ->where('author', '=', $userId)
            ->get()
            ->toArray();

        foreach ($courses as $course) {
            $membersCount = DB::table('enlistments')
                ->where('course_id', $course->id)
                ->where('status', 'accepted')
                ->get()
                ->toArray();
            $enlistmentsCount = DB::table('enlistments')
                ->where('course_id', $course->id)
                ->where('status', 'processing')
                ->get()
                ->toArray();

            $course->members = count($membersCount);
            $course->enlistments = count($enlistmentsCount);
        }

        return $courses;
    }

    public function disableCourse($courseId)
    {
        return DB::table('courses')
            ->where('id', $courseId)
            ->update(['visible' => 0]);
    }

    public function enableCourse($courseId)
    {
        return DB::table('courses')
            ->where('id', $courseId)
            ->update(['visible' => 1]);
    }

    public function deleteCourse($courseId)
    {
        return DB::table('courses')
            ->where('id', $courseId)
            ->delete();
    }

    private function generateDefaultProfileInfo($userId)
    {
        $userInformationService = new UserInformationService;

        return $userInformationService->userInformationAutomization($userId);
    }
}
