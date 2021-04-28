<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class search extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $categories;
    public $action;
    public function __construct()
    {
        $this->categories = Category::all();
        $this->action = route('search');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.search');
    }
}
