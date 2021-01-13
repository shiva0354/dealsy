@extends('layouts.layout')
@section('title', $category->name ?? '' )
@section('content')
    @include('layouts.search')
    <section class="section-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-result bg-gray">
                        <h2>Results For "{{$category->name ?? ''}}"</h2>
                        <p>{{$posts->total()}} Results on {{now()}}</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Sub Category</a></li>
                        <li><a href="#">Sub Category in state</a></li>
                        <li><a href="#">Sub Category in city</a></li>
                        <li><a href="#">Sub Category in locality</a></li>
                      </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="category-sidebar">
                        <div class="widget category-list">
                            @if (!$category->parent_id) 
                                <a href="{{route('search.category',[$category->slug,$category->id])}}">
                                    <h4 class="widget-header">{{$category->name}}</h4>
                                </a>
                                <ul class="category-list">
                                @foreach ($category->subCategories as $subcategory)
                                            <li>
                                                <a href="{{ route('search.category', [$subcategory->slug, $subcategory->id]) }}">{{ $subcategory->name }}<span>{{ $subcategory->posts()->count() }}</span></a>
                                            </li>
                                @endforeach
                                </ul>
                            @else
                                <h4 class="widget-header">All Category</h4>
                                <ul class="category-list">
                                @foreach (App\Models\Category::whereNull('parent_id')->get() as $category)
                                        <li>
                                                <a href="{{ route('search.category', [$category->slug, $category->id]) }}">{{ $category->name }}<span>{{ $category->posts()->count() }}</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="widget category-list">
                            <h4 class="widget-header">Nearby</h4>
                            <ul class="category-list">
                                <li><a href="category.html">New York <span>93</span></a></li>
                                <li><a href="category.html">New Jersy <span>233</span></a></li>
                                <li><a href="category.html">Florida <span>183</span></a></li>
                                <li><a href="category.html">California <span>120</span></a></li>
                                <li><a href="category.html">Texas <span>40</span></a></li>
                                <li><a href="category.html">Alaska <span>81</span></a></li>
                                <li><a href="category.html">Alaska <span>81</span></a></li>
                                <li><a href="category.html">Alaska <span>81</span></a></li>
                                <li><a href="category.html">Alaska <span>81</span></a></li>
                                <li><a href="category.html">Alaska <span>81</span></a></li>
                                <li><a href="category.html">Alaska <span>81</span></a></li>
                                <li><a href="category.html">Alaska <span>81</span></a></li>
                                <li><a href="category.html">Alaska <span>81</span></a></li>
                            </ul>
                        </div>

                        {{-- <div class="widget filter">
                            <h4 class="widget-header">Show Produts</h4>
                            <select>
                                <option>Popularity</option>
                                <option value="1">Top rated</option>
                                <option value="2">Lowest Price</option>
                                <option value="4">Highest Price</option>
                            </select>
                        </div> --}}

                        {{-- <div class="widget price-range w-100">
                            <h4 class="widget-header">Price Range</h4>
                            <div class="block">
                                <input class="range-track w-100" type="text" data-slider-min="0" data-slider-max="5000"
                                    data-slider-step="5" data-slider-value="[0,5000]">
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="value">$10 - $5000</span>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="widget product-shorting">
                            <h4 class="widget-header">By Condition</h4>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Brand New
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Almost New
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Gently New
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Havely New
                                </label>
                            </div>
                        </div> --}}

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
                                            <a href="#" onclick="event.preventDefault();" class="text-info"><i
                                                    class="fa fa-th fa-lg"></i></a>
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
                                            <div class="price">₹{{$post->expected_price}}</div>
                                            <a href="single.html">
                                                <img class="card-img-top img-fluid"
                                                    src="{!!  asset('theme/images/products/products-1.jpg') !!}"
                                                    alt="Card image cap">
                                            </a>
                                        </div>
                                        <span class="wishlist"><a href="javascript:;"
                                                onclick="addTowishlist('product_id');"><i class="fa fa-heart-o fa-lg"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="favourite"></i></a></span>
                                        <div class="card-body">
                                            <h4 class="card-title"><a href="{{single.html}}">{{$post->title}}</a></h4>
                                            <ul class="list-inline product-meta">
                                                <li class="list-inline-item">
                                                    <a href="{{single.html}}"><i class="fa fa-folder-open-o"></i>{{$post->category}}</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#"><i class="fa fa-calendar"></i>{{$post->created_at}}</a>
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
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
