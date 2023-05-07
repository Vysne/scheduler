<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\DashboardTableService;

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

        return redirect('dashboard');
    }

    public function enableAction($courseId)
    {
        $dashboardTableService = new DashboardTableService;

        $dashboardTableService->enableCourse($courseId);

        return redirect('dashboard');
    }

    public function deleteAction($courseId)
    {
        $dashboardTableService = new DashboardTableService;

        $dashboardTableService->deleteCourse($courseId);

        return redirect('dashboard');
    }
}
