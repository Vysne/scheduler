<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AchievementService;

class AchievementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $achievementService = new AchievementService;

        return view('achievements-page', ['achievements' => $achievementService->getAchievements()]);
    }
}
