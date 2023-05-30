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

        return DB::table('courses')
            ->select('id', 'course_name', 'type', 'rating', 'visible')
            ->where('author', '=', $userId)
            ->get()
            ->toArray();
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
