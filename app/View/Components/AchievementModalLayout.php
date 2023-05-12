<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AchievementModalLayout extends Component
{
    public $achievement;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($achievement)
    {
        $this->achievement = $achievement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.achievement-modal-layout');
    }
}
