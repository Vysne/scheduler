<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MessageFormModalLayout extends Component
{
    public $member;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.message-form-modal-layout');
    }
}
