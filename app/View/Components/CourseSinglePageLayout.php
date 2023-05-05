<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CourseSinglePageLayout extends Component
{
    public $courseSingleData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($courseSingleData)
    {
        $this->courseSingleData = $courseSingleData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.course-single-page-layout');
    }
}
