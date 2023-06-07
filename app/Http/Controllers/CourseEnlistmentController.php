<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\EnlistmentService;
use App\Models\Course;

class CourseEnlistmentController extends Controller
{
    public function index($courseId)
    {
        $enlistmentService = new EnlistmentService;

        return view('course-members-page', ['enlistments' => $enlistmentService->getCourseEnlistments($courseId), 'members' => $enlistmentService->getCourseMembers($courseId), 'course' => $enlistmentService->getCourseLimit($courseId)]);
    }

    public function acceptAction($courseId, $userId)
    {
        $enlistmentService = new EnlistmentService;

        $enlistmentService->acceptUser($courseId, $userId);

        return redirect('/members/' . $courseId)->with(['notifier' => ['notifier_id' => 17 ,'notifier_title' => 'Request approved', 'notifier_detail' => 'User request was approved.']]);
    }

    public function declineAction($courseId, $userId)
    {
        $enlistmentService = new EnlistmentService;

        $enlistmentService->declineUser($courseId, $userId);

        return redirect('/members/' . $courseId)->with(['notifier' => ['notifier_id' => 16 ,'notifier_title' => 'Request denied', 'notifier_detail' => 'User request was declined.']]);
    }

    public function achievementAction(Request $request, $courseId, $userId)
    {
        $enlistmentService = new EnlistmentService;

        $enlistmentService->assignAchievement($courseId, $userId, $request);

        return redirect('/members/' . $courseId)->with(['notifier' => ['notifier_id' => 15 ,'notifier_title' => 'Achievement assigned', 'notifier_detail' => 'Achievement was assigned.']]);
    }

    public function updateLimit($courseId, Request $request)
    {
        $currentMembersCount = DB::table('enlistments')
            ->where('course_id', $courseId)
            ->where('status', 'accepted')
            ->count();

        if ($currentMembersCount <= $request['course-limit'] || $request['course-limit'] === null) {
            Course::where('id', $courseId)
                ->update([
                    'limit' => $request['course-limit'] ?? 0
                ]);
        } else {

            return redirect('/members/' . $courseId)->with(['notifier' => ['notifier_id' => 6 ,'notifier_title' => 'Change unsuccessful', 'notifier_detail' => 'Course limit is lower than current members count.']]);
        }

        return redirect('/members/' . $courseId)->with(['notifier' => ['notifier_id' => 7 ,'notifier_title' => 'Change successful', 'notifier_detail' => 'Course limit was updated.']]);
    }

    public function dropMember($courseId, $userId)
    {
        DB::table('enlistments')
            ->where('course_id', $courseId)
            ->where('user_id', $userId)
            ->delete();

        return redirect('/members/' . $courseId)->with(['notifier' => ['notifier_id' => 18 ,'notifier_title' => 'Change successful', 'notifier_detail' => 'User was removed from course.']]);
    }

    public function messageAction($courseId, $userId, Request $request)
    {
        DB::table('messages')
            ->insert([
                'sender_id' => request('sender_id'),
                'receiver_id' => request('receiver_id'),
                'message' => request('message')
            ]);

        return redirect('/members/' . $courseId)->with(['notifier' => ['notifier_id' => 19 ,'notifier_title' => 'Message sent', 'notifier_detail' => 'Your message was sent.']]);
    }
}
