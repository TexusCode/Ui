<?php

namespace Texuscode\Ui\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public function __construct($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('texus::components.button');
    }
}
