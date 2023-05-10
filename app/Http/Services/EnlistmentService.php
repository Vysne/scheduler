<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnlistmentService
{
    public function checkEnlistment()
    {
        $availability = [];
        $userId = Auth::id();

        $enlistmentData = DB::table('enlistments')
            ->where('user_id', '=', $userId)
            ->get()
            ->toArray();

        foreach ($enlistmentData as $data) {
            $availability[$data->course_id] = $data->status;
        }

        return $availability;
    }

//    TODO WILL ADD PROGRESS VALUE
    public function getEnlistments()
    {
        $userId = Auth::id();

        $userEnlistments = DB::table('enlistments')
            ->join('courses', 'enlistments.course_id', '=', 'courses.id')
//            ->join('users', 'enlistments.user_id', '=', 'users.id')
            ->select('courses.id', 'courses.course_name', 'courses.type', 'enlistments.status')
            ->where('enlistments.user_id', '=', $userId)
            ->where('courses.visible', '=', 1)
            ->get();

        return $userEnlistments;
    }
}
