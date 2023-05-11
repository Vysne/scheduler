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

    public function getCourseEnlistments($courseId)
    {
        $courseEnlistments = DB::table('enlistments')
            ->join('users', 'enlistments.user_id', '=', 'users.id')
            ->join('user_information', 'enlistments.user_id', '=', 'user_information.user_id')
            ->join('courses', 'enlistments.course_id', '=', 'courses.id')
            ->select('users.id', 'users.name', 'user_information.title', 'user_information.email', 'user_information.mobile', 'user_information.location', 'user_information.user-image', 'user_information.aboutme-descr-body', 'courses.id', 'courses.course_name', 'enlistments.user_id', 'enlistments.status', 'enlistments.created_at')
            ->where('enlistments.course_id', '=', $courseId)
            ->get();

        return json_decode(json_encode($courseEnlistments), true);
    }

    public function getCourseMembers($courseId)
    {
        $courseMembers = DB::table('enlistments')
            ->join('users', 'enlistments.user_id', '=', 'users.id')
            ->join('user_information', 'enlistments.user_id', '=', 'user_information.user_id')
            ->join('courses', 'enlistments.course_id', '=', 'courses.id')
            ->select('users.id', 'users.name', 'user_information.title', 'user_information.email', 'user_information.mobile', 'user_information.location', 'user_information.user-image', 'user_information.aboutme-descr-body', 'courses.id', 'courses.course_name', 'enlistments.user_id', 'enlistments.status', 'enlistments.created_at', 'enlistments.updated_at')
            ->where('enlistments.course_id', '=', $courseId)
            ->where('enlistments.status', '=', 'accepted')
            ->get();

        return json_decode(json_encode($courseMembers), true);
    }

    public function acceptUser($courseId, $userId)
    {
        return DB::table('enlistments')
            ->where('enlistments.course_id', '=', $courseId)
            ->where('enlistments.user_id', '=', $userId)
            ->update([
                'status' => 'accepted'
            ]);
    }

    public function declineUser($courseId, $userId)
    {
        return DB::table('enlistments')
            ->where('enlistments.course_id', '=', $courseId)
            ->where('enlistments.user_id', '=', $userId)
            ->delete();
    }
}
