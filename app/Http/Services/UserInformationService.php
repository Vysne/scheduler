<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInformation;

class UserInformationService
{
    public function loadUserInformation()
    {
        $userId = Auth::id();

        $userInfoData = $this->getUserInformation($userId);

        if (!$userInfoData) {
            $userInfoData = $this->userInformationAutomization($userId);
        }

        return $userInfoData;
    }

    public function updateUserInformation($request, $userId)
    {
        $filePath = $request->file('profile-img')->store('public');

        return DB::table('user_information')
            ->where('user_id', '=', $userId)
            ->update([
                'title' => $request['user-name'],
                'email' => $request['user-email'],
                'status' => $request['user-status'],
                'mobile' => $request['user-mobile'],
                'location' => $request['user-location'],
                'user-image' => str_replace('public', 'storage', $filePath),
                'aboutme-descr-body' => $request['aboutme-descr-body']
            ]);
    }

    private function getUserInformation($userId)
    {
        return UserInformation::where('user_id', '=', $userId)->get()->toArray();
    }

    private function userInformationAutomization($userId)
    {
        $userLoginData = DB::table('users')
            ->select('name', 'email', 'status')
            ->where('id', '=', $userId)
            ->get();

        foreach($userLoginData as $loginData) {
            DB::table('user_information')
                ->insert([
                    'user_id' => $userId,
                    'title' => $loginData->name,
                    'email' => $loginData->email,
                    'status' => $loginData->status,
                    'user-image' => 'user-profile.svg'
                ]);
        }

        return $this->getUserInformation($userId);
    }
}
