<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\DashboardTableService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function disableAction($courseId)
    {
        $dashboardTableService = new DashboardTableService;

        $dashboardTableService->disableCourse($courseId);

        return redirect('dashboard')->with(['notifier' => ['notifier_id' => 10 ,'notifier_title' => 'Update successful', 'notifier_detail' => 'The course was disabled.']]);
    }

    public function enableAction($courseId)
    {
        $dashboardTableService = new DashboardTableService;

        $dashboardTableService->enableCourse($courseId);

        return redirect('dashboard')->with(['notifier' => ['notifier_id' => 9 ,'notifier_title' => 'Update successful', 'notifier_detail' => 'The course was published.']]);
    }

    public function deleteAction($courseId)
    {
        $dashboardTableService = new DashboardTableService;

        $dashboardTableService->deleteCourse($courseId);

        return redirect('dashboard');
    }

    public function leaveAction($courseId)
    {
        $userId = Auth::id();

        DB::table('enlistments')
            ->where('course_id', $courseId)
            ->where('user_id', $userId)
            ->delete();

        return redirect('dashboard')->with(['notifier' => ['notifier_id' => 8 ,'notifier_title' => 'Update successful', 'notifier_detail' => 'You left the course.']]);
    }
}
