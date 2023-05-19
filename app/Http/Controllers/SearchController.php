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
            ->where('course_name', 'LIKE', "%{$search}%")
            ->orWhere('type', 'LIKE', "%{$search}%")
            ->get();

        return view('search-page', ['courses' => compact('courses'), 'availability' => $enlistmentService->checkEnlistment()]);
    }
}
