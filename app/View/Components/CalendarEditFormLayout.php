<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CalendarEditFormLayout extends Component
{
    public $events;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($events)
    {
        $this->events = $events;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.calendar-edit-form-layout');
    }
}
