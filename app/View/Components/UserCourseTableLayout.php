<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Services\DashboardTableService;

class UserCourseTableLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $userCreatedCourses = new DashboardTableService;

        return view('components.user-course-table-layout', ['userContents' => $userCreatedCourses->showCreatedCourses()]);
    }
}
