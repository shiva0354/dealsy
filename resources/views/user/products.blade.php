<?php if ($category) {
$title = $category->name;
} elseif ($location) {
$title = $location->name;
} else {
$title = 'Search Results';
} ?>
@extends('layouts.layout')
@section('title', $title)
@section('content')
    <section class="page-search">
        <x-search />
    </section>
    <section class="section-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-result bg-gray">
                        <h2>Results For "@if ($category){{ $category->name }}
                        @elseif($location) {{ $location->name }} @else Search @endif"</h2>
                    <p>{{ $posts->total() }} Results on {{ now()->toDateString() }}</p>
                </div>
            </div>
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    @if ($category->parent)
                        <li><a
                                href="{{ route('search.category', [$category->parent->slug, $category->parent]) }}">{{ $category->parent->name }}</a>
                        </li>
                    @endif
                    @if ($category)
                        <li><a
                                href="{{ route('search.category', [$category->slug, $category]) }}">{{ $category->name }}</a>
                        </li>
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
                                        <a
                                            href="{{ route('search.category', [$category->slug, $category->id]) }}">{{ $category->name }}<span>{{ $category->posts_count }}</span></a>
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
                                            <li><a
                                                    href="{{ route('search.location.category', [$city->slug, $city->id, $category->slug, $category->id]) }}">{{ $city->name }}</a>
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
                                        <li><a
                                                href="{{ route('search.location.category', [$location->slug, $location->id, $category->slug, $category->id]) }}">{{ $location->name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            @else
                                @if ($location)
                                    @if (!$location->parent_id)
                                        @foreach ($location->cities as $city)
                                            <li><a
                                                    href="{{ route('search.location', [$city]) }}">{{ $city->name }}</a>
                                            </li>
                                        @endforeach
                                    @elseif($location->parent_id)
                                        @foreach ($location->posts()->distinct('locality') as $locality)
                                            <li><a
                                                    href="{{ route('search.locality', [$location->slug, $location->id, $locality]) }}">{{ $locality }},{{ $location->name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                @else
                                    @foreach (App\Models\Location::whereNull('parent_id')->get() as $location)
                                        <li><a
                                                href="{{ route('search.location', [$location->slug, $location->id]) }}">{{ $location->name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                {{-- <div class="category-search-filter">
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
                        </div> --}}
                <div class="product-grid-list">
                    <div class="row">
                        @foreach ($posts as $post)
                            @include('components.item')
                        @endforeach
                    </div>
                </div>
                <div class="pagination justify-content-center">
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js-script')
{{-- <script>
    $(document).ready(function() {
        $(document).on('click', '#addToWishlist', function(evt) {
            var id = $(this).data('data');
            $.ajax({
                type: "GET",
                url: "/posts/wishlist/" + id,
                dataType: "json",
                success: function(data) {
                    if (data == "unauthenticated") {
                        alert("Please login first!");
                        window.location="/login";
                    } else if (data.type == "attach") {
                        $("#wishlist" + id).removeClass("text-white");
                        console.log(data['message']);
                    } else if (data.type == "detach") {
                        $("#wishlist" + id).addClass("text-white");
                    }
                }
            });
        });
    });

</script> --}}
@stop
