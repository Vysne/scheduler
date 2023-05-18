<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\GoogleAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarApiController extends Controller
{
    private string $googleCalendarUrl;
    private string $googleCalendarID;
    private string $googleAccessToken;
    private Client $client;
    private const GOOGLE_CALENDAR_EVENTS_ENDPOINT = '/events';

    public function __construct(Client $client)
    {
//        $this->middleware('auth');
        $this->googleCalendarUrl = config('services.google.crud_url');
        $this->client = $client;
    }

    public function getEvents()
    {
        $this->googleCalendarID = GoogleAccount::where('user_id',  Auth::id())->first()->value('email');

        $this->googleAccessToken = GoogleAccount::where('user_id', Auth::id())->first()->value('access_token');

        $result = $this->client->request(
            'GET',
            $this->googleCalendarUrl . $this->googleCalendarID . self::GOOGLE_CALENDAR_EVENTS_ENDPOINT,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->googleAccessToken
                ]
            ]
        )->getBody()->getContents();

        return json_decode($result, true);
    }

    public function createEvent(Request $request)
    {
        $this->googleAccessToken = DB::table('google_accounts')->where('user_id', $request->request->get('userId'))->value('access_token');

        $event = [
            'summary' => $request->request->get('summary'),
            'location' => $request->request->get('location'),
            'description' => $request->request->get('description'),
            'start' => [
                'dateTime' => $request->request->get('event-start-date') . 'T' . $request->request->get('event-start-time') . ':00',
                'timeZone' => $request->request->get('timeZone')
            ],
            'end' => [
                'dateTime' => $request->request->get('event-end-date') . 'T' . $request->request->get('event-end-time') . ':00',
                'timeZone' => $request->request->get('timeZone')
            ],
            'reminders' => [
                'useDefault' => 'false',
                'overrides' => [
                    [
                        'method' => 'email',
                        'minutes' => 1440
                    ],
                    [
                        'method' => 'popup',
                        'minutes' => 10
                    ]
                ],
            ]
        ];

        $this->client->request(
            'POST',
            $this->googleCalendarUrl . $request->request->get('email') . self::GOOGLE_CALENDAR_EVENTS_ENDPOINT,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->googleAccessToken,
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($event)
            ]
        );

        return redirect()->route('google.index');
    }

    public function updateEvent(Request $request, $id)
    {
        $this->googleAccessToken = DB::table('google_accounts')->where('user_id', $request->request->get('userId'))->value('access_token');
        $this->googleCalendarID = DB::table('google_accounts')->where('user_id', $request->request->get('userId'))->value('email');

        $event = [
            'summary' => $request->request->get('summary'),
            'location' => $request->request->get('location'),
            'description' => $request->request->get('description'),
            'start' => [
                'dateTime' => $request->request->get('event-start-date') . 'T' . $request->request->get('event-start-time') . ':00',
                'timeZone' => $request->request->get('timeZone')
            ],
            'end' => [
                'dateTime' => $request->request->get('event-end-date') . 'T' . $request->request->get('event-end-time') . ':00',
                'timeZone' => $request->request->get('timeZone')
            ],
            'reminders' => [
                'useDefault' => 'false',
                'overrides' => [
                    [
                        'method' => 'email',
                        'minutes' => 1440
                    ],
                    [
                        'method' => 'popup',
                        'minutes' => 10
                    ]
                ],
            ]
        ];

        $this->client->request(
            'PUT',
            $this->googleCalendarUrl . $this->googleCalendarID . self::GOOGLE_CALENDAR_EVENTS_ENDPOINT . '/' . $id,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->googleAccessToken,
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($event)
            ]
        );

        return redirect()->route('google.index');
    }

    public function deleteEvent(Request $request, $id)
    {
        $this->googleAccessToken = DB::table('google_accounts')->where('user_id', $request->request->get('userId'))->value('access_token');
        $this->googleCalendarID = DB::table('google_accounts')->where('user_id', $request->request->get('userId'))->value('email');

        $this->client->request(
            'DELETE',
            $this->googleCalendarUrl . $this->googleCalendarID . self::GOOGLE_CALENDAR_EVENTS_ENDPOINT . '/' . $id,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->googleAccessToken,
                    'Content-Type' => 'application/json'
                ],
            ]
        );

        return redirect()->route('google.index');
    }
}
