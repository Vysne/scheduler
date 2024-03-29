<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin-panel-page', ['applications' => $this->getApplications(), 'courses' => $this->getCoursesWithCreatorData()]);
    }

    private function getApplications()
    {
        $applications = DB::table('applications')
            ->join('users', 'applications.user_id', '=', 'users.id')
            ->join('user_information', 'users.id', '=', 'user_information.user_id')
            ->select('applications.user_id', 'applications.status', 'applications.created_at', 'user_information.title', 'user_information.email', 'user_information.mobile', 'user_information.location', 'user_information.user-image', 'user_information.aboutme-descr-body')
            ->get();

        return json_decode(json_encode($applications), true);
    }

    public function acceptAction($userId)
    {
        DB::table('applications')
            ->where('applications.user_id', '=', $userId)
            ->update([
                'status' => 'accepted'
            ]);

        DB::table('users')
            ->where('users.id', '=', $userId)
            ->update([
                'status' => 'creator'
            ]);

        return redirect('/admin-panel')->with(['notifier' => ['notifier_id' => 11 ,'notifier_title' => 'Request approved', 'notifier_detail' => 'User received course creator status.']]);
    }

    public function declineAction($userId)
    {
        DB::table('applications')
            ->where('applications.user_id', '=', $userId)
            ->delete();

        return redirect('/admin-panel')->with(['notifier' => ['notifier_id' => 12 ,'notifier_title' => 'Request denied', 'notifier_detail' => 'User did not receive course creator status.']]);
    }

    public function getCoursesWithCreatorData()
    {
        $result = DB::table('courses')
            ->join('user_information', 'courses.author', '=', 'user_information.user_id')
            ->select(
                'courses.id',
                'courses.course_name',
                'courses.author',
                'courses.image',
                'courses.type',
                'courses.visible',
                'courses.updated_at',
                'user_information.title',
                'user_information.email'
            )
            ->where('courses.visible', '=', 0)
            ->orWhere('courses.visible', '=', 2)
            ->get();

        return json_decode(json_encode($result), true);
    }

    public function acceptCourseAction($courseId)
    {
        DB::table('courses')
            ->where('courses.id', '=', $courseId)
            ->update([
                'visible' => 1
            ]);

        return redirect('/admin-panel')->with(['notifier' => ['notifier_id' => 13 ,'notifier_title' => 'Request approved', 'notifier_detail' => 'Course was approved and published.']]);
    }

    public function declineCourseAction($courseId)
    {
        DB::table('courses')
            ->where('courses.id', '=', $courseId)
            ->update([
                'visible' => 3
            ]);

        return redirect('/admin-panel')->with(['notifier' => ['notifier_id' => 14 ,'notifier_title' => 'Request denied', 'notifier_detail' => 'Course was not approved.']]);
    }
}
