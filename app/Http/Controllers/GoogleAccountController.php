<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Google;
use App\Models\GoogleAccount;
use App\Http\Controllers\Api\CalendarApiController;
use Illuminate\Support\Facades\DB;

class GoogleAccountController extends Controller
{
    private $calendarApiController;

    public function __construct(CalendarApiController $calendarApiController)
    {
        $this->middleware('auth');
        $this->calendarApiController = $calendarApiController;
    }

    public function index()
    {
        return view('calendar-page', [
            'accounts' => GoogleAccount::where('user_id', auth()->id())->first(),
            'events' => $this->calendarApiController->getEvents(),
//            'accounts' => auth()->user()->googleAccounts,
        ]);
    }

    public function store(Request $request, Google $google)
    {
        if (! $request->has('code')) {
            return redirect($google->createAuthUrl());
        }

        $google->authenticate($request->get('code'));

        $account = $google->service('Oauth2');
        $userInfo = $account->userinfo->get();
        $token = $google->getAccessToken();

        auth()->user()->googleAccounts()->updateOrCreate(
            [
                'user_id' => auth()->id(),
            ],
            [
                'email' =>$userInfo->email,
                'access_token' => $token['access_token'],
            ]
        );


        $google->connectUsing($token['access_token'])->service('Calendar');

        return redirect()->route('google.index');
    }

    public function destroy($email, Google $google)
    {
        $record = GoogleAccount::where('email', '=', $email)->get();

        DB::table('google_accounts')->where('email', '=', $email)->delete();

        $google->revokeToken($record->pluck('access_token')[0]);

        return redirect()->route('calendar');
    }
}
