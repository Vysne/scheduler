<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserInformationService;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userInformationSerivce = new UserInformationService;

        return view('profile-page', ['user' => $userInformationSerivce->loadUserInformation()]);
    }

    public function update(Request $request)
    {
        $userInformationSerivce = new UserInformationService;

        $userId = Auth::id();

        $userInformationSerivce->updateUserInformation($request, $userId);

        return redirect('profile');
    }
}
