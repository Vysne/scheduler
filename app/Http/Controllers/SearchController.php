<?php

namespace App\Http\Controllers;

use App\Http\Services\EnlistmentService;
use App\Models\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $enlistmentService = new EnlistmentService;
        $search = $request->input('search');

        $courses = Course::query()
            ->join('user_information', 'courses.author', '=', 'user_information.user_id')
            ->select('courses.id', 'courses.course_name', 'courses.author', 'courses.image', 'courses.type', 'courses.visible', 'user_information.title')
            ->where('course_name', 'LIKE', "%{$search}%")
            ->orWhere('type', 'LIKE', "%{$search}%")
            ->get();

        return view('search-page', ['courses' => json_decode(json_encode($courses), true), 'availability' => $enlistmentService->checkEnlistment()]);
    }
}
