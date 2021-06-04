<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use romanzipp\Seo\Structs\Link;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Script;

class AddSeoDefaults
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        seo()->charset();
        seo()->viewport();

        seo()->title('Buy & Sell Near You');
        seo()->description('My Description');

        seo()->csrfToken();

        seo()->addMany([

            Meta::make()->name('copyright')->content('Dealsy'),

            Meta::make()->name('mobile-web-app-capable')->content('yes'),
            Meta::make()->name('theme-color')->content('#f03a17'),

            Link::make()->rel('icon')->href(asset('images/classimax_favicon.jpg')),

            OpenGraph::make()->property('title')->content('Buy & Sell Near You'),
            OpenGraph::make()->property('site_name')->content('Dealsy'),
            OpenGraph::make()->property('locale')->content('en_IN'),

            Twitter::make()->name('card')->content('summary_large_image'),
            Twitter::make()->name('site')->content('@dealsy'),
            Twitter::make()->name('creator')->content('@dealsy'),
            Twitter::make()->name('image')->content(asset('images/classimax_logo.jpg'), false)

        ]);

        // seo('body')->add(
        //     Script::make()->attr('src', '/js/app.js')
        // );

        return $next($request);
    }
}
