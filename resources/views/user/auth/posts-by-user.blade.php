@extends('layouts.layout')
@section('content')
    @include('layouts.search')
    <section class="section-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-result bg-gray">
                        <h2>Results For "Electronics"</h2>
                        <p>123 Results on 12 December, 2017</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Sub Category</a></li>
                        <li><a href="#">Sub Category in state</a></li>
                        <li><a href="#">Sub Category in city</a></li>
                        <li><a href="#">Sub Category in locality</a></li>
                      </ul>
                </div>
            </div>
            <div class="row">
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
                                                    class="fa fa-th-large"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="ad-list-view.html"><i class="fa fa-reorder"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-grid-list">
                        <div class="row mt-30">
                            <div class="col-sm-12 col-lg-4 col-md-6">
                                <!-- product card -->
                                <div class="product-item bg-light">
                                    <div class="card">
                                        <div class="thumb-content">
                                            <div class="price">$200</div>
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
                                            <h4 class="card-title"><a href="single.html">11inch Macbook Air</a></h4>
                                            <ul class="list-inline product-meta">
                                                <li class="list-inline-item">
                                                    <a href="single.html"><i class="fa fa-folder-open-o"></i>Electronics</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#"><i class="fa fa-calendar"></i>26th December</a>
                                                </li>
                                            </ul>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                Explicabo, aliquam!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
