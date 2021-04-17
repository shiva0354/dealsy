@extends('layouts.layout')
{{-- defining page title --}}
@section('title', 'Buy & Sell Near You')
@section('content')
    <!--===============================
                                =            Hero Area            =
                                ================================-->
    <section class="hero-area bg-1 text-center overly">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Header Contetnt -->
                    <div class="content-block">
                        <h1>Buy & Sell Near You </h1>
                        <p>Join the millions who buy and sell from each other <br> everyday in local communities around the
                            world</p>
                        <div class="short-popular-category-list text-center">
                            <h2>Popular Category</h2>
                            <ul class="list-inline">
                                @foreach ($categories as $category)
                                    <li class="list-inline-item mb-2">
                                        <a href="{{ route('search.category', [$category->slug, $category->id]) }}"><i class="{{ $category->icon }}"></i>{{ $category->name }}</a>
                                    </li>
                                @endforeach
                                {{-- @for ($i = 0; $i < 9; $i++)
                                    <li class="list-inline-item">
                                        <a
                                            href="{{ route('search.category', [$categories[$i]->slug, $categories[$i]->id]) }}"><i
                                                class="fa fa-grav"></i>{{ $categories[$i]->name }}</a>
                                    </li>
                                @endfor --}}
                            </ul>
                        </div>
                    </div>
                    <!-- Advance Search -->
                    <x-search />
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>

    <!--===================================
                                =            Client Slider            =
                                ====================================-->


    <!--===========================================
                                =            Popular deals section            =
                                ============================================-->

    <section class="popular-deals section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>Trending Adds</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, magnam.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- offer 01 -->
                <div class="col-lg-12">
                    <div class="trending-ads-slide">
                        @foreach ($posts as $post)
                            <div class="col-sm-12 col-lg-4">
                                <!-- product card -->
                                <div class="product-item bg-light">
                                    <div class="card">
                                        <div class="thumb-content">
                                            <div class="price">₹{{ $post->expected_price }}</div>
                                            <a href="single.html">
                                                <img class="card-img-top img-fluid" src="{!! asset('theme/images/products/products-2.jpg') !!}" alt="Card image cap">
                                            </a>
                                        </div>
                                        <span class="wishlist"><a href="javascript:;" onclick="addTowishlist('product_id');"><i class="fa fa-heart-o fa-lg" data-toggle="tooltip" data-placement="top"
                                                    title="favourite"></i></a></span>
                                        <div class="card-body">
                                            <h4 class="card-title"><a href="single.html">{{ $post->title }}</a></h4>
                                            <ul class="list-inline product-meta">
                                                <li class="list-inline-item">
                                                    <a href="single.html"><i class="fa fa-folder-open-o"></i>{{ $post->category->name ?? '' }}</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#"><i class="fa fa-calendar"></i>{{ $post->created_at }}</a>
                                                </li>
                                            </ul>
                                            {{-- <p class="card-text">{{ $post->detail }}
                                            </p> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================================
                                =            All Category Section            =
                                ===========================================-->
    <section class=" section">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section title -->
                    <div class="section-title">
                        <h2>All Categories</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, provident!</p>
                    </div>
                    <div class="row">
                        @foreach ($categories as $category)
                            <!-- Category list -->
                            <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                                <div class="category-block">
                                    <div class="header">
                                        <i class="{{ $category->icon }} icon-bg-{{ rand(1, 8) }}"></i>
                                        <a href="{{ route('search.category', [$category->slug, $category->id]) }}">
                                            <h4>{{ $category->name }}</h4>
                                        </a>
                                    </div>
                                    <ul class="category-list" style="height:150px; max-height: 150px; overflow-x:hidden;">
                                        @foreach ($category->subCategories as $subcategory)
                                            <li>
                                                <a
                                                    href="{{ route('search.category', [$subcategory->slug, $subcategory->id]) }}">{{ $subcategory->name }}<span>{{ $subcategory->posts_count }}</span></a>
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
