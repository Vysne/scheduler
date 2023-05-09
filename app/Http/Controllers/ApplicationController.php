<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ApplicationService;
use Illuminate\Support\Facades\Auth;

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

        return redirect('dashboard');
    }
}
