@extends('layouts.layout')
@section('seo')
@include('layouts.item-seo')
@endsection
@section('content')
    <section class="page-search">
        <x-search />
    </section>
    <section class="section bg-gray">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <!-- Left sidebar -->
                <div class="col-md-8">
                    <div class="product-details">
                        {{-- breadcrumb --}}
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            @if ($post->category->parent)
                                <li><a
                                        href="{{ route('search.category', [$post->category->parent->slug, $post->category->parent]) }}">{{ $post->category->parent->name }}</a>
                                </li>
                            @endif
                            <li><a
                                    href="{{ route('search.category', [$post->category->slug, $post->category]) }}">{{ $post->category->name }}</a>
                            </li>
                            @if ($post->state)
                                <li><a
                                        href="{{ route('search.location.category', [$post->state->slug, $post->state->id, $post->category->slug, $post->category->id]) }}">{{ $post->category->name }}
                                        in {{ $post->state->name }}</a></li>
                            @endif
                            @if ($post->city)
                                <li><a
                                        href="{{ route('search.location.category', [$post->city->slug, $post->city->id, $post->category->slug, $post->category->id]) }}">{{ $post->category->name }}
                                        in {{ $post->city->name }}</a></li>
                            @endif
                            @if ($post->locality)
                                <li><a
                                        href="{{ route('search.locality.category', [$post->city->slug, $post->city->id, str_replace(' ', '-', strtolower($post->locality)), $post->category->slug, $post->category->id]) }}">{{ $post->category->name }}
                                        in {{ $post->locality }}, {{ $post->city->name }}</a></li>
                            @endif
                        </ul>
                        <h1 class="product-title">{{ $post->title }}</h1>
                        <div class="product-meta">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-user-o"></i> By <a
                                        href="{{ route('users.posts', $post->user) }}">{{ $post->user->name }}</a>
                                </li>
                                <li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Category<a
                                        href="{{ route('search.category', [$post->category->slug, $post->category]) }}">{{ $post->category->name }}</a>
                                </li>
                                <li class="list-inline-item"><i class="fa fa-location-arrow"></i>
                                    Location<a>{{ $post->postLocation() }}</a></li>
                            </ul>
                        </div>

                        <!-- product slider -->
                        <div class="product-slider">
                            @foreach ($post->postImages as $image)
                                <div class="product-slider-item my-4"
                                    data-image="{{ asset('uploads/posts/' . $image->image) }}">
                                    <img class="img-fluid w-100" src="{{ asset('uploads/posts/' . $image->image) }}"
                                        alt="product-img">
                                </div>
                            @endforeach
                        </div>
                        <!-- product slider -->
                        <!-- Sharer Widget -->
                        <div id="social-share">

                            <a href="" data-toggle="tooltip" data-placement="top" title="Social Share" id="share">
                                <i class="fas fa-share-alt my-social"></i>
                            </a>

                            {{-- <a href="{{ url()->current() }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Instagram" id="instagram">
                                <i class="fab fa-instagram my-social"></i>
                            </a> --}}
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}"
                                target="_blank" data-toggle="tooltip" data-placement="top" title="Linkedin" id="linkedin">
                                <i class="fab fa-linkedin my-social"></i>
                            </a>

                            <a href="http://reddit.com/submit?url={{ url()->current() }}" target="_blank"
                                data-toggle="tooltip" data-placement="top" title="Reddit" id="reddit">
                                <i class="fab fa-reddit-alien my-social"></i>
                            </a>

                            <a href="whatsapp://send?text={{ url()->current() }}" target="_blank" data-toggle="tooltip"
                                data-placement="top" title="Whatsapp" id="whatsapp">
                                <i class="fab fa-whatsapp my-social"></i>
                            </a>

                            <a href="http://twitter.com/share?url={{ url()->current() }}" target="_blank"
                                data-toggle="tooltip" data-placement="top" title="Twitter" id="twitter">
                                <i class="fab fa-twitter my-social"></i>
                            </a>

                            <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank"
                                data-toggle="tooltip" data-placement="top" title="Facebook" id="facebook">
                                <i class="fab fa-facebook-f my-social"></i>
                            </a>

                        </div>
                        <!-- // Sharer wideget end -->
                        <div class="content">
                            {{-- <ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
								 aria-selected="true">Product Details</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
								 aria-selected="false">Specifications</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact"
								 aria-selected="false">Reviews</a>
							</li>
						</ul> --}}
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <h3 class="tab-title">Description</h3>
                                    <p>{{ $post->detail }}</p>
                                </div>
                                {{-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<h3 class="tab-title">Product Specifications</h3>
								<table class="table table-bordered product-table">
									<tbody>
										<tr>
											<td>Seller Price</td>
											<td>$450</td>
										</tr>
										<tr>
											<td>Added</td>
											<td>26th December</td>
										</tr>
										<tr>
											<td>State</td>
											<td>Dhaka</td>
										</tr>
										<tr>
											<td>Brand</td>
											<td>Apple</td>
										</tr>
										<tr>
											<td>Condition</td>
											<td>Used</td>
										</tr>
										<tr>
											<td>Model</td>
											<td>2017</td>
										</tr>
										<tr>
											<td>State</td>
											<td>Dhaka</td>
										</tr>
										<tr>
											<td>Battery Life</td>
											<td>23</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
								<h3 class="tab-title">Product Review</h3>
								<div class="product-review">
									<div class="media">
										<!-- Avater -->
										<img src="images/user/user-thumb.jpg" alt="avater">
										<div class="media-body">
											<!-- Ratings -->
											<div class="ratings">
												<ul class="list-inline">
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
												</ul>
											</div>
											<div class="name">
												<h5>Jessica Brown</h5>
											</div>
											<div class="date">
												<p>Mar 20, 2018</p>
											</div>
											<div class="review-comment">
												<p>
													Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremqe laudant tota rem ape
													riamipsa eaque.
												</p>
											</div>
										</div>
									</div>
									<div class="review-submission">
										<h3 class="tab-title">Submit your review</h3>
										<!-- Rate -->
										<div class="rate">
											<div class="starrr"></div>
										</div>
										<div class="review-submit">
											<form action="#" class="row">
												<div class="col-lg-6">
													<input type="text" name="name" id="name" class="form-control" placeholder="Name">
												</div>
												<div class="col-lg-6">
													<input type="email" name="email" id="email" class="form-control" placeholder="Email">
												</div>
												<div class="col-12">
													<textarea name="review" id="review" rows="10" class="form-control" placeholder="Message"></textarea>
												</div>
												<div class="col-12">
													<button type="submit" class="btn btn-main">Sumbit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="widget price text-center">
                            <h4>Price</h4>
                            <p>₹ {{ $post->price }}</p>
                        </div>
                        <!-- User Profile widget -->
                        <div class="widget user text-center sticky-top">
                            <img class="rounded-circle img-fluid mb-2 px-2" width="160px"
                                src="{{ asset($post->user->avatar) }}" alt="{{ $post->user->name ?? '' }}">
                            <h4><a href="">{{ $post->user->name }}</a></h4>
                            <p class="member-time">Member Since {{ date_format($post->user->created_at, 'M d,Y') }}</p>
                            <a href="{{ route('users.posts', $post->user) }}">See all ads by this seller</a>
                            <ul class="list-inline mt-20">
                                @if (Auth::check() && Auth::user()->mobile)
                                    <li class="list-inline-item"><a href="tel:{{ $post->user->mobile }}"
                                            class="btn btn-offer d-inline-block  btn-primary px-lg-5 my-1 px-md-3"><i
                                                class="fa fa-phone fa-lg"></i>&nbsp; Call Now</a></li>
                                    <li class="list-inline-item">
                                        <form action="{{ route('user.auth.send.message', $post) }}" method="post">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-offer d-inline-block btn-primary px-lg-5 my-1 px-md-3">Make
                                                an Offer</button>
                                        </form>
                                    </li>
                                @else
                                    <li class="list-inline-item"><a href=""
                                            class="btn btn-offer d-inline-block  btn-primary px-lg-5 my-1 px-md-3"><i
                                                class="fa fa-phone fa-lg"></i>&nbsp; Call Now</a></li>
                                    <li class="list-inline-item"><a href="void(0);"
                                            class="btn btn-offer d-inline-block btn-primary px-lg-5 my-1 px-md-3"
                                            data-toggle="modal" data-target="#makeOffer">Make
                                            an offer</a></li>
                                @endif
                            </ul>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="makeOffer" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Send Message Request</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('user.send.message', $post) }}" method="post">
                                            @csrf
                                            <input class="form-control mb-2" type="text" name="name"
                                                placeholder="Enter Name">
                                            <input class="form-control mb-2" type="email" name="email"
                                                placeholder="Enter email">
                                            <input class="form-control mb-2" type="number" name="mobile"
                                                placeholder="Enter mobile No.">
                                            <button type="submit" class="btn btn-primary w-100">Send</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <!-- Map Widget -->
					<div class="widget map">
						<div class="map">
							<div id="map_canvas" data-latitude="51.507351" data-longitude="-0.127758"></div>
						</div>
					</div>
					<!-- Rate Widget -->
					<div class="widget rate">
						<!-- Heading -->
						<h5 class="widget-header text-center">What would you rate
							<br>
							this product</h5>
						<!-- Rate -->
						<div class="starrr"></div>
					</div> --}}
                        <!-- Safety tips widget -->
                        <div class="widget disclaimer">
                            <h5 class="widget-header">Safety Tips</h5>
                            <ul>
                                <li><i class="fas fa-caret-right text-primary"></i> Meet seller at a public place</li>
                                <li><i class="fas fa-caret-right text-primary"></i> Check the item before you buy</li>
                                <li><i class="fas fa-caret-right text-primary"></i> Pay only after collecting the item</li>
                            </ul>
                        </div>
                        <!-- Coupon Widget -->
                        <div class="widget coupon text-center">
                            <!-- Coupon description -->
                            <p>Have a great product to post ? Share it with
                                your fellow users.
                            </p>
                            <!-- Submii button -->
                            <a href="" class="btn btn-transparent-white">Submit Listing</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- Container End -->
    </section>
    @include('layouts.footer-main')
@endsection
@section('js-script')
    <script>
        $('#makeOffer').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
@stop
