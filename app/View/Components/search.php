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
        $this->categories = cache()->remember('search-category', 60 * 60 * 24, function () {
            return Category::all(['id', 'slug', 'name']);
        });
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
