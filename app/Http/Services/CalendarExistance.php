<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\GoogleAccount;

class CalendarExistance
{
    public function getUserRecord()
    {
        $userId = Auth::id();

        return GoogleAccount::where('user_id', '=', $userId)->get()->toArray();
    }
}
