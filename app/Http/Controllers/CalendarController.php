<?php

namespace App\Http\Controllers;

use App\Models\GoogleAccount;
use Illuminate\Http\Request;
use App\Http\Services\CalendarExistance;
use App\Http\Controllers\Api\CalendarApiController;

class CalendarController extends Controller
{
    private $calendarExistance;
    private $calendarApiController;

    public function __construct(CalendarExistance $calendarExistance, CalendarApiController $calendarApiController)
//    public function __construct(CalendarExistance $calendarExistance)
    {
        $this->middleware('auth');
        $this->calendarExistance = $calendarExistance;
        $this->calendarApiController = $calendarApiController;
    }

    public function index()
    {
        /** @var GoogleAccount $record */
        $record = GoogleAccount::where('user_id', auth()->id())
            ->first();
        if (null === $record) {
            return view('calendar-no-auth');
        }

//        return view('calendar-page', [
//            'accounts' => $record,
//            'events' => $this->calendarApiController->getEvents(),
//        ]);
    }

    //Form request
    public function create(Request $request)
    {
        return 'test';
    }

//    public function
}
