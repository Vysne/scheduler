<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationService
{
    public function storeApplication($userId)
    {
        return DB::table('applications')
            ->insert([
                'user_id' => $userId
            ]);
    }

    public function getApplication()
    {
        $userId = Auth::id();

        $applicationData = DB::table('applications')
            ->where('user_id', '=', $userId)
            ->get()
            ->toArray();

        if (!$applicationData) {

            return $applicationData = [''];
        } else {

            return $applicationData;
        }
    }
}
