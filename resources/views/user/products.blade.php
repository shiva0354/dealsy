@extends('layouts.layout')
@if ($category)
    @section('title', $category->name)
    @elseif($location)
    @section('title', $location->name)
    @else
    @section('title', 'Search Results')
    @endif
    @section('content')
        <section class="page-search">
            <x-search />
        </section>
        <section class="section-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-result bg-gray">
                            <h2>Results For "@if ($category){{ $category->name }} @elseif($location) {{ $location->name }} @else Search @endif"</h2>
                            <p>{{ $posts->total() }} Results on {{ now()->toDateString() }}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            @if ($category)
                                <li><a href="#">{{ $category->name }}</a></li>
                            @endif
                            @if ($location)
                                <li><a href="#">{{ $location->name }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="category-sidebar">
                            <div class="widget category-list">
                                @if ($category)
                                    @if (!$category->parent_id)
                                        <a href="{{ route('search.category', [$category->slug, $category->id]) }}">
                                            <h4 class="widget-header">{{ $category->name }}</h4>
                                        </a>
                                        <ul class="category-list">
                                            @foreach ($category->subCategories as $subcategory)
                                                <li>
                                                    <a
                                                        href="{{ route('search.category', [$subcategory->slug, $subcategory->id]) }}">{{ $subcategory->name }}<span>{{ $subcategory->posts_count }}</span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <h4 class="widget-header">Similar Category</h4>
                                        <ul class="category-list">
                                            @foreach (App\Models\Category::where('parent_id', $category->parent_id)->get() as $subcategory)
                                                <li>
                                                    <a
                                                        href="{{ route('search.category', [$subcategory->slug, $subcategory->id]) }}">{{ $subcategory->name }}<span>{{ $subcategory->posts_count }}</span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @else
                                    <h4 class="widget-header">All Category</h4>
                                    <ul class="category-list">
                                        @foreach (App\Models\Category::whereNull('parent_id')->get() as $category)
                                            <li>
                                                <a href="{{ route('search.category', [$category->slug, $category->id]) }}">{{ $category->name }}<span>{{ $category->posts_count }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="widget category-list">
                                <h4 class="widget-header">Nearby</h4>
                                <ul class="category-list">
                                    @if ($category)
                                        @if ($location)

                                            @if (!$location->parent_id)
                                                @foreach ($location->cities as $city)
                                                    <li><a href="{{ route('search.location.category', [$city->slug, $city->id, $category->slug, $category->id]) }}">{{ $city->name }}</a>
                                                    </li>
                                                @endforeach
                                            @elseif($location->parent_id)
                                                @foreach ($location->posts()->distinct('locality') as $locality)
                                                    <li><a
                                                            href="{{ route('search.locality.category', [$location->slug, $location->id, $locality, $category->slug, $category->id]) }}">{{ $locality }},{{ $location->name }}</a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        @else
                                            @foreach (App\Models\Location::whereNull('parent_id')->get() as $location)
                                                <li><a href="{{ route('search.location.category', [$location->slug, $location->id, $category->slug, $category->id]) }}">{{ $location->name }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                    @else
                                        @if ($location)
                                            @if (!$location->parent_id)
                                                @foreach ($location->cities as $city)
                                                    <li><a href="{{ route('search.location', [$city]) }}">{{ $city->name }}</a></li>
                                                @endforeach
                                            @elseif($location->parent_id)
                                                @foreach ($location->posts()->distinct('locality') as $locality)
                                                    <li><a href="{{ route('search.locality', [$location->slug, $location->id, $locality]) }}">{{ $locality }},{{ $location->name }}</a></li>
                                                @endforeach
                                            @endif
                                        @else
                                            @foreach (App\Models\Location::whereNull('parent_id')->get() as $location)
                                                <li><a href="{{ route('search.location', [$location->slug, $location->id]) }}">{{ $location->name }}</a></li>
                                            @endforeach
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="category-search-filter">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Sort</strong>
                                    <select>
                                        <option>Most Recent</option>
                                        <option value="1">Most Popular</option>
                                        <option value="2">Lowest Price</option>
                                        <option value="4">Highest Price</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="view">
                                        <strong>Views</strong>
                                        <ul class="list-inline view-switcher">
                                            <li class="list-inline-item">
                                                <a href="#" onclick="event.preventDefault();" class="text-info"><i class="fa fa-th fa-lg"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="ad-list-view.html"><i class="fas fa-list fa-lg"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-grid-list">
                            <div class="row mt-30">
                                @foreach ($posts as $post)
                                    <div class="col-sm-12 col-lg-4 col-md-6">
                                        <!-- product card -->
                                        <div class="product-item bg-light">
                                            <div class="card">
                                                <div class="thumb-content">
                                                    <div class="price">₹{{ $post->expected_price }}</div>
                                                    <a href="single.html">
                                                        <img class="card-img-top img-fluid" src="{!! asset('theme/images/products/products-1.jpg') !!}" alt="Card image cap">
                                                    </a>
                                                </div>
                                                <span class="wishlist"><a href="javascript:;" onclick="addTowishlist('product_id');"><i class="fa fa-heart-o fa-lg" data-toggle="tooltip" data-placement="top"
                                                            title="favourite"></i></a></span>
                                                <div class="card-body">
                                                    <h4 class="card-title"><a href="{{ single . html }}">{{ $post->title }}</a></h4>
                                                    <ul class="list-inline product-meta">
                                                        <li class="list-inline-item">
                                                            <a href="{{ single . html }}"><i class="fa fa-folder-open-o"></i>{{ $post->category }}</a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#"><i class="fa fa-calendar"></i>{{ $post->created_at }}</a>
                                                        </li>
                                                    </ul>
                                                    {{-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                Explicabo, aliquam!</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pagination justify-content-center">
                            {{-- <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav> --}}
                            {{ $posts->links('pagination::simple-default') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endsection
