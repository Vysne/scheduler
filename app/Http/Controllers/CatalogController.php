<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return DB::table('courses')
            ->join('users', 'courses.author', '=', 'users.id')
            ->select('courses.id', 'courses.course_name', 'courses.image', 'courses.type', 'users.name')
            ->paginate(3);
//            ->get()
//            ->toArray();
    }
}
