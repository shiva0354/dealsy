<div class="col-sm-12 col-lg-4 col-md-6">
    <!-- product card -->
    <div class="product-item bg-light">
        <div class="card">
            <div class="thumb-content">
                <div class="price">₹ {{ $post->price }}</div>
                <a href="{{ route('posts.show', [$post, strtolower(str_replace(' ', '-', $post->title))]) }}">
                    <img class=" card-img-top img-fluid" src="{{ asset('uploads/posts/' . $post->postImages->first()->image) }}" alt="{{ $post->title }}" style="height: 200px;">
                </a>
            </div>
            <span class="wishlist" id="addToWishlist" data-data="{{ $post->id }}" ><i class="fa fa-heart fa-lg text-white"
                data-toggle="tooltip" data-placement="top" title="favourite" id="wishlist{{ $post->id }}"></i></span>
            <div class="card-body">
                <h4 class="card-title"><a href="{{ route('posts.show', [$post, strtolower(str_replace(' ', '-', $post->title))]) }}">{{ substr($post->title, 0, 35) }}...</a></h4>
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
