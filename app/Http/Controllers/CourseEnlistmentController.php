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

        return redirect('/members/' . $courseId);
    }

    public function declineAction($courseId, $userId)
    {
        $enlistmentService = new EnlistmentService;

        $enlistmentService->declineUser($courseId, $userId);

        return redirect('/members/' . $courseId);
    }

    public function achievementAction(Request $request, $courseId, $userId)
    {
        $enlistmentService = new EnlistmentService;

        $enlistmentService->assignAchievement($courseId, $userId, $request);

        return redirect('/members/' . $courseId);
    }

    public function updateLimit($courseId, Request $request)
    {
        Course::where('id', $courseId)
            ->update([
                'limit' => $request['course-limit']
            ]);

        return redirect('/members/' . $courseId);
    }

    public function dropMember($courseId, $userId)
    {
        DB::table('enlistments')
            ->where('course_id', $courseId)
            ->where('user_id', $userId)
            ->delete();

        return redirect('/members/' . $courseId);
    }

    public function messageAction($courseId, $userId, Request $request)
    {
        DB::table('messages')
            ->insert([
                'sender_id' => request('sender_id'),
                'receiver_id' => request('receiver_id'),
                'message' => request('message')
            ]);

        return redirect('/members/' . $courseId);
    }
}
