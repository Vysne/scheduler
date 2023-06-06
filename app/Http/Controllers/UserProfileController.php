<?php

namespace App\Http\Controllers;

use App\Http\Services\ApplicationService;
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
        $applicationService = new ApplicationService;

        return view('profile-page', ['user' => $userInformationSerivce->loadUserInformation(), 'applicationData' => $applicationService->getUserApplication(Auth::id())]);
    }

    public function update(Request $request)
    {
        $userInformationSerivce = new UserInformationService;

        $userId = Auth::id();

        $userInformationSerivce->updateUserInformation($request, $userId);

        return redirect('profile')->with(['notifier' => ['notifier_id' => 3 ,'notifier_title' => 'Updated successfully', 'notifier_detail' => 'Your profile was updated.']]);
    }
}
