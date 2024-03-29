<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/search/', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');

Route::get('/messages/{user_id}', [App\Http\Controllers\MessageController::class, 'index'])->name('messages/{user_id}');
Route::post('/messages/{user_id}/send', [App\Http\Controllers\MessageController::class, 'sendMessage'])->name('messages/{user_id}/send');

Route::get('/profile', [App\Http\Controllers\UserProfileController::class, 'index'])->name('profile');
Route::post('/update-profile', [App\Http\Controllers\UserProfileController::class, 'update'])->name('update-profile');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::post('/leave/{id}', [App\Http\Controllers\HomeController::class, 'leaveAction'])->name('/leave/{id}');
Route::post('/disable/{id}', [App\Http\Controllers\HomeController::class, 'disableAction'])->name('/disable/{id}');
Route::post('/enable/{id}', [App\Http\Controllers\HomeController::class, 'enableAction'])->name('/enable/{id}');
Route::post('/delete/{id}', [App\Http\Controllers\HomeController::class, 'deleteAction'])->name('/delete/{id}');
Route::get('/members/{id}', [App\Http\Controllers\CourseEnlistmentController::class, 'index'])->name('/members/{id}');
Route::post('/members/{id}/update-limit', [App\Http\Controllers\CourseEnlistmentController::class, 'updateLimit'])->name('/members/{id}/update-limit');
Route::post('/members/{id}/accept/{user_id}', [App\Http\Controllers\CourseEnlistmentController::class, 'acceptAction'])->name('/members/{id}/accept/{user_id}');
Route::post('/members/{id}/decline/{user_id}', [App\Http\Controllers\CourseEnlistmentController::class, 'declineAction'])->name('/members/{id}/decline/{user_id}');
Route::post('/members/{id}/achievement/{user_id}', [App\Http\Controllers\CourseEnlistmentController::class, 'achievementAction'])->name('/members/{id}/achievement/{user_id}');
Route::get('/members/{id}/drop/{user_id}', [App\Http\Controllers\CourseEnlistmentController::class, 'dropMember'])->name('/members/{id}/drop/{user_id}');
Route::post('/members/{id}/message/{user_id}', [App\Http\Controllers\CourseEnlistmentController::class, 'messageAction'])->name('/members/{id}/message/{user_id}');

Route::get('/courses', [App\Http\Controllers\CatalogController::class, 'index'])->name('courses');
Route::post('/join/{id}', [App\Http\Controllers\CatalogController::class, 'joinAction'])->name('/join/{id}');
Route::get('/course-single/{id}', [App\Http\Controllers\CourseSingleController::class, 'index'])->name('course-single/{id}');
Route::post('/course-single/{id}/rate', [App\Http\Controllers\CourseSingleController::class, 'rateCourse'])->name('course-single/{id}/rate');
Route::get('/course-single/{id}/mark-complete/{condition_id}', [App\Http\Controllers\CourseSingleController::class, 'markComplete'])->name('course-single/{id}/mark-complete/{condition_id}');
Route::get('/course-single/{id}/mark-not-complete/{condition_id}', [App\Http\Controllers\CourseSingleController::class, 'markNotComplete'])->name('course-single/{id}/mark-not-complete/{condition_id}');

Route::get('/create-course', [App\Http\Controllers\CourseController::class, 'index'])->name('create-course');
Route::post('/create', [App\Http\Controllers\CourseController::class, 'create'])->name('create');
Route::get('/edit-course/{id}', [App\Http\Controllers\CourseController::class, 'show'])->name('edit-course/{id}');
Route::post('/update', [App\Http\Controllers\CourseController::class, 'update'])->name('update');
Route::post('/remove', [App\Http\Controllers\CourseController::class, 'remove'])->name('remove');

Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
Route::name('google.index')->get('google', [App\Http\Controllers\GoogleAccountController::class, 'index']);
Route::name('google.store')->get('google/oauth', [App\Http\Controllers\GoogleAccountController::class, 'store']);
Route::name('google.destroy')->get('google/{email}', [App\Http\Controllers\GoogleAccountController::class, 'destroy']);

Route::get('/achievements', [App\Http\Controllers\AchievementsController::class, 'index'])->name('achievements');

Route::get('/terms-and-conditions', [App\Http\Controllers\TermsAndConditionsController::class, 'index'])->name('terms-and-conditions');
Route::post('/apply', [App\Http\Controllers\ApplicationController::class, 'index'])->name('apply');
Route::get('/cancel/{id}', [App\Http\Controllers\ApplicationController::class, 'cancelApplication'])->name('cancel/{id}');

Route::get('/admin-panel', [App\Http\Controllers\AdminPanelController::class, 'index'])->name('admin-panel');
Route::post('/admin-panel/accept/{user_id}', [App\Http\Controllers\AdminPanelController::class, 'acceptAction'])->name('/admin-panel/accept/{user_id}');
Route::post('/admin-panel/decline/{user_id}', [App\Http\Controllers\AdminPanelController::class, 'declineAction'])->name('/admin-panel/decline/{user_id}');
Route::post('/admin-panel/course/accept/{course_id}', [App\Http\Controllers\AdminPanelController::class, 'acceptCourseAction'])->name('/admin-panel/course/accept/{course_id}');
Route::post('/admin-panel/course/decline/{course_id}', [App\Http\Controllers\AdminPanelController::class, 'declineCourseAction'])->name('/admin-panel/course/decline/{course_id}');
