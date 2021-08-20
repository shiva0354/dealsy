<?php

namespace App\Http\View\Composers;

use App\Models\SeoTool;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoComposer
{
    /**
     * The user repository implementation.
     *
     * @var string
     */
    protected $url;

    /**
     * Create a new profile composer.
     *
     * @param  Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        // Dependencies are automatically resolved by the service container...
        $this->url = $request->path();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $seo = SeoTool::findByUrl('/' . $this->url);
        $view->with('seo', $seo ?? null);
    }
}
