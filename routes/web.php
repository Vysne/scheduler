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

Route::get('/profile', [App\Http\Controllers\UserProfileController::class, 'index'])->name('profile');
Route::post('/update', [App\Http\Controllers\UserProfileController::class, 'update'])->name('update');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::post('/disable/{id}', [App\Http\Controllers\HomeController::class, 'disableAction'])->name('/disable/{id}');
Route::post('/enable/{id}', [App\Http\Controllers\HomeController::class, 'enableAction'])->name('/enable/{id}');
Route::post('/delete/{id}', [App\Http\Controllers\HomeController::class, 'deleteAction'])->name('/delete/{id}');

Route::get('/courses', [App\Http\Controllers\CatalogController::class, 'index'])->name('courses');
Route::post('/join/{id}', [App\Http\Controllers\CatalogController::class, 'joinAction'])->name('/join/{id}');
Route::get('/course-single/{id}', [App\Http\Controllers\CourseSingleController::class, 'index'])->name('course-single/{id}');

Route::get('/create-course', [App\Http\Controllers\CourseController::class, 'index'])->name('create-course');
Route::post('/create', [App\Http\Controllers\CourseController::class, 'create'])->name('create');
Route::get('/edit-course/{id}', [App\Http\Controllers\CourseController::class, 'show'])->name('edit-course/{id}');
Route::get('/update', [App\Http\Controllers\CourseController::class, 'update'])->name('update');

Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');

Route::get('/terms-and-conditions', [App\Http\Controllers\TermsAndConditionsController::class, 'index'])->name('terms-and-conditions');
Route::post('/apply', [App\Http\Controllers\ApplicationController::class, 'index'])->name('apply');

Route::get('/admin-panel', [App\Http\Controllers\AdminPanelController::class, 'index'])->name('admin-panel');
