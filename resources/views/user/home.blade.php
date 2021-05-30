@extends('layouts.layout')
{{-- defining page title --}}
@section('title', 'Buy & Sell Near You')
@section('content')
    <section class="hero-area bg-1 text-center overly">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Header Contetnt -->
                    <div class="content-block">
                        <h1>@lang("site.home-heading")</h1>
                        <p>@lang("site.home-sub-heading")</p>
                        <div class="short-popular-category-list text-center">
                            <h2>@lang("category.Popular Category")</h2>
                            <ul class="list-inline">
                                @foreach ($categories as $category)
                                    <li class="list-inline-item mb-2">
                                        <a href="{{ route('search.category', [$category->slug, $category->id]) }}"><i
                                                class="{{ $category->icon }}"></i>@lang("category.$category->name")</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Advance Search -->
                    <x-search />
                    {{-- <x-search :categories="$categories" /> --}}
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>

    <section class="popular-deals section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>@lang("category.Trending Ads")</h2>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, magnam.</p> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- offer 01 -->
                <div class="col-lg-12">
                    <div class="trending-ads-slide">
                        @foreach ($posts as $post)
                            @include('components.item')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" section">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section title -->
                    <div class="section-title">
                        <h2>@lang("category.All Categories")</h2>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, provident!</p> --}}
                    </div>
                    <div class="row">
                        @foreach ($categories as $category)
                            <!-- Category list -->
                            <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                                <div class="category-block">
                                    <div class="header">
                                        <i class="{{ $category->icon }} icon-bg-{{ rand(1, 8) }}"></i>
                                        <a href="{{ route('search.category', [$category->slug, $category->id]) }}">
                                            <h4>@lang("category.$category->name")</h4>
                                        </a>
                                    </div>
                                    <ul class="category-list" style="height:150px; max-height: 150px; overflow-x:hidden;">
                                        @foreach ($category->subCategories as $subcategory)
                                            <li>
                                                <a
                                                    href="{{ route('search.category', [$subcategory->slug, $subcategory->id]) }}">@lang("category.$subcategory->name")<span>{{ $subcategory->posts_count }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>
    {{-- Call to action section --}}
    @include('layouts.footer-call-to-action')
    @include('layouts.footer-main')
@endsection
