<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('catalog');
    }

    public function getCourses()
    {
        $filterValues = [];

        if (array_key_exists('filters', $_GET)) {
            foreach($_GET['filters'] as $key => $filter ) {
                if ($filter != "") {
                    $filterValues['filters'] = [str_replace('-', '.', $key) => $filter];
//                    $filterValues['filters'] = [$key => $filter];
                }
            }
        }

        if (empty($filterValues)) {

            return DB::table('courses')
                ->join('users', 'courses.author', '=', 'users.id')
                ->select('courses.id', 'courses.course_name', 'courses.author', 'courses.image', 'courses.type', 'courses.enlistments', 'courses.rating', 'users.name')
                ->where('courses.visible', '=', 1)
                ->paginate(3);
        } else {

            return $this->filterCourses($filterValues);
        }
    }

    public function joinAction($courseId)
    {
        $userId = Auth::id();

        DB::table('enlistments')
            ->insert([
                'course_id' => $courseId,
                'user_id' => $userId,
                ]);

        return redirect('courses');
    }

    public function filterCourses($filterValues)
    {
        return DB::table('courses')
            ->join('users', 'courses.author', '=', 'users.id')
            ->select('courses.id', 'courses.course_name', 'courses.author', 'courses.image', 'courses.type', 'courses.enlistments', 'courses.rating', 'users.name')
            ->where('courses.visible', '=', 1)
            ->where(function($query) use($filterValues) {
                foreach ($filterValues['filters'] as $key => $filter) {
                    $query->where($key, '=', $filter);
                }
            })->paginate(3);
    }
}
