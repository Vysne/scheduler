<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserProfileModalLayout extends Component
{
    public $enlistment;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($enlistment)
    {
        $this->enlistment = $enlistment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-profile-modal-layout');
    }
}
