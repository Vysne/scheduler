<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\CatalogController;
use App\Http\Services\EnlistmentService;

class ContentLayout extends Component
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
        $courses = new CatalogController;
        $enlistmentService = new EnlistmentService;

        return view('components.content-layout', ['courses' => $courses->getCourses(), 'availability' => $enlistmentService->checkEnlistment()]);
    }
}
