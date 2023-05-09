<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CourseSingleHeaderLayout extends Component
{
    public $courseSingleData;

    public $availability;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($courseSingleData, $availability)
    {
        $this->courseSingleData = $courseSingleData;
        $this->availability = $availability;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.course-single-header-layout');
    }
}
