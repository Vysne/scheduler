<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ApplicationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $applicationService = new ApplicationService;

        $userId = Auth::id();

        $applicationService->storeApplication($userId);

        return redirect('dashboard')->with(['notifier' => ['notifier_id' => 20 ,'notifier_title' => 'Request sent', 'notifier_detail' => 'Course creator status request sent.']]);
    }

    public function cancelApplication($userId)
    {
        DB::table('applications')
            ->where('user_id', $userId)
            ->delete();

        return redirect('dashboard')->with(['notifier' => ['notifier_id' => 21 ,'notifier_title' => 'Request cancelled', 'notifier_detail' => 'Course creator status request was cancelled.']]);
    }
}
