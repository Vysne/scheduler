<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use App\Models\UserInformation;
use App\Http\Controllers\MessageController;

class navbarLayout extends Component
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
        $messageController = new MessageController;

        return view('components.navbar-layout', ['userData' => $this->getUserLogo(), 'messages' => $messageController->showMessages()]);
    }

    private function getUserLogo()
    {
        $userId = Auth::id();

        return UserInformation::where('user_id', '=', $userId)->get('user-image')->toArray();
    }
}
