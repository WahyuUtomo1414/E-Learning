<?php

namespace App\View\Components\Layouts;

use Closure;
use Filament\Facades\Filament;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Base extends Component
{
    public $user;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($title = 'SMKPATRIOTNUSANTARA')
    {
        $this->user = Filament::auth()->user();
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.layouts.base', [
            'user' => $this->user,
            'title' => $this->title,
        ]);
    }
}
