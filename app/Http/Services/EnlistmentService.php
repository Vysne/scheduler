<?php

namespace App\Http\Services;

use Illuminate\Database\Query\Builder;
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

    public function getEnlistments()
    {
        $userId = Auth::id();

        $userEnlistments = DB::table('enlistments')
            ->join('courses', 'enlistments.course_id', '=', 'courses.id')
            ->select('courses.id', 'courses.course_name', 'courses.type', 'courses.image', 'enlistments.status')
            ->where('enlistments.user_id', '=', $userId)
            ->where('courses.visible', '=', 1)
            ->get();

        foreach($userEnlistments as $enlistment) {
            $enlistment->progress = $this->progressValue($userId, $enlistment->id);
        }

        return $userEnlistments;
    }

    public function progressValue($userId, $courseId)
    {
        $courseSyllabusCount = DB::table('course_information')
            ->where('course_id', $courseId)
            ->whereNotNull('syllabus-name')
            ->get();

        $userMarkedSyllabus = DB::table('progress')
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->get();

        return count($userMarkedSyllabus) / count($courseSyllabusCount) * 100;
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

        foreach($courseMembers as $member) {
            $member->progress = $this->progressValue($member->user_id, $member->id);
        }

        return json_decode(json_encode($courseMembers), true);
    }

    public function acceptUser($courseId, $userId)
    {
        DB::table('enlistments')
            ->where('enlistments.course_id', '=', $courseId)
            ->where('enlistments.user_id', '=', $userId)
            ->update([
                'status' => 'accepted'
            ]);

        $currentEnlistmentCount = DB::table('enlistments')
            ->where('enlistments.course_id', '=', $courseId)
            ->where('enlistments.status', '=', 'accepted')
            ->get();

        return DB::table('courses')
            ->where('courses.id', '=', $courseId)
            ->update([
                'enlistments' => count($currentEnlistmentCount)
            ]);

//        return DB::table('enlistments')
//            ->where('enlistments.course_id', '=', $courseId)
//            ->where('enlistments.user_id', '=', $userId)
//            ->update([
//                'status' => 'accepted'
//            ]);
    }

    public function declineUser($courseId, $userId)
    {
        return DB::table('enlistments')
            ->where('enlistments.course_id', '=', $courseId)
            ->where('enlistments.user_id', '=', $userId)
            ->delete();
    }

    public function assignAchievement($courseId, $userId, $request)
    {
        return DB::table('achievements')
            ->insert([
                'course_id' => $courseId,
                'user_id' => $userId,
                'achievement_creator' => $request['achievement-creator'],
                'achievement_title' => $request['achievement-title'],
                'achievement_descr_body' => $request['achievement-body']
            ]);
    }

    public function getCourseLimit($courseId)
    {
        return DB::table('courses')
            ->where('courses.id', '=', $courseId)
            ->select('courses.id', 'courses.limit')
            ->get()
            ->first();
    }
}
