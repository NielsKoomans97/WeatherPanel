<?php

namespace App\View\Components\radar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use League\CommonMark\Util\HtmlElement;

class controls extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $frames
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radar.controls');
    }
}
