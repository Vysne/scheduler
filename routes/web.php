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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/courses', [App\Http\Controllers\CatalogController::class, 'index'])->name('courses');

Route::get('/create-course', [App\Http\Controllers\CourseController::class, 'index'])->name('create-course');

Route::get('/course-single', [App\Http\Controllers\CourseSingleController::class, 'index'])->name('course-single');
