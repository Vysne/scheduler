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

        return $userInfoData;
    }

    public function updateUserInformation($request, $userId)
    {
        if ($request->file('profile-img')) {
            $filePath = $request->file('profile-img')->store('public');
            $fileName = str_replace('public', 'storage', $filePath);
        } else {
            $fileName = 'user-profile.svg';
        }

        return DB::table('user_information')
            ->where('user_id', '=', $userId)
            ->update([
                'title' => $request['user-name'],
                'email' => $request['user-email'],
                'status' => $request['user-status'],
                'mobile' => $request['user-mobile'],
                'location' => $request['user-location'],
                'user-image' => $fileName,
                'aboutme-descr-body' => $request['aboutme-descr-body']
            ]);
    }

    public function getUserInformation($userId)
    {
        return UserInformation::where('user_id', '=', $userId)->get()->toArray();
    }

    public function userInformationAutomization($userId)
    {
        $userLoginData = DB::table('users')
            ->select('name', 'email', 'status')
            ->where('id', '=', $userId)
            ->get();

        if (UserInformation::where('user_id', '=', $userId)->exists() === false) {
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
        }

        return $this->getUserInformation($userId);
    }
}
