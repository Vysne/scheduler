<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Services\ApplicationService;

class ApplicationModalLayout extends Component
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
        $applicationService = new ApplicationService;

        return view('components.application-modal-layout', ['application' => $applicationService->getApplication()]);
    }
}
