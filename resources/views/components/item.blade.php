<div class="col-sm-12 col-lg-4 col-md-6">
    <!-- product card -->
    <div class="product-item bg-light">
        <div class="card">
            <div class="thumb-content">
                <div class="price">₹ {{ $post->price }}</div>
                <a href="{{ route('posts.show', [$post, strtolower(str_replace(' ', '-', $post->title))]) }}">
                    <img class=" card-img-top img-fluid" src="{!! asset('theme/images/products/products-1.jpg') !!}" alt="Card image cap">
                </a>
            </div>
            <span class="wishlist"><a href="javascript:;" onclick="addTowishlist('product_id');"><i class="fa fa-heart-o fa-lg" data-toggle="tooltip" data-placement="top"
                        title="favourite"></i></a></span>
            <div class="card-body">
                <h4 class="card-title"><a href="{{ route('posts.show', [$post, strtolower(str_replace(' ', '-', $post->title))]) }}">{{ $post->title }}</a></h4>
                <ul class="list-inline product-meta">
                    <li class="list-inline-item">
                        <a href="{{ route('search.category', [$post->category->slug, $post->category->id]) }}"><i class="fa fa-folder-open-o"></i>{{ $post->category->name }}</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#"><i class="fa fa-calendar"></i>{{ date_format($post->created_at, 'd M,Y') }}</a>
                    </li>
                </ul>
                {{-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                Explicabo, aliquam!</p> --}}
            </div>
        </div>
    </div>
</div>
