<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $color,
        public string $type,
    )
    { }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }

    public function boot(): void
    {
    Blade::component('package-button', Button::class);
    }
}
