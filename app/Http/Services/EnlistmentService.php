<?php

namespace App\Http\Services;

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
}
