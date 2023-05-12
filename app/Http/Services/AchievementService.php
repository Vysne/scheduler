<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AchievementService
{
    public function getAchievements()
    {
        $userId = Auth::id();

        return DB::table('achievements')
            ->join('users', 'achievements.user_id', '=', 'users.id')
            ->join('courses', 'achievements.course_id', '=', 'courses.id')
            ->select(
                'achievements.course_id',
                'achievements.user_id',
                'achievements.achievement_creator',
                'achievements.achievement_title',
                'achievements.achievement_descr_body',
                'achievements.created_at',
                'users.name',
                'courses.course_name',
                'courses.type',
                'courses.image'
            )
            ->where('achievements.user_id', '=', $userId)
            ->paginate(3);
    }
}
