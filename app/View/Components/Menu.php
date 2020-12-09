<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $active;

    public function __construct($active)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data = ['Dashboar','Home'];

        return view('components.menu',['list'=>$data]);
    }
}
