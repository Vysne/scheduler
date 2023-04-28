<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardTableService
{
    public function showCreatedCourses()
    {
        $userId = Auth::user()->getAuthIdentifier();

        return DB::table('courses')
            ->select('id', 'course_name', 'type')
            ->where('author', '=', $userId)
            ->get()
            ->toArray();
    }
}
