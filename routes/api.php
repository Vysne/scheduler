<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CalendarApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    [
        'prefix' => 'google',
        'namespace' => 'Google',
        'middleware' => ['api']
    ],
    static function () {
        Route::get('/', [CalendarApiController::class, 'getEvents'])
            ->name('google.get-events');
        Route::post('/create', [CalendarApiController::class, 'createEvent'])
            ->name('google.create-event');
        Route::put('/update/{id}', [CalendarApiController::class, 'updateEvent'])
            ->name('google.update-event');
        Route::delete('/delete/{id}', [CalendarApiController::class, 'deleteEvent'])
            ->name('google.delete-event');
    }
);
