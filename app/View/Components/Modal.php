<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $titulo = null;
    public $id = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $titulo)
    {
        $this->id = $id;
        $this->titulo = $titulo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
