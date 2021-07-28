@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
    <section class="dashboard section">
        <!-- Container Start -->
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                    <div class="sidebar">
                        <!-- User Widget -->
                        <div class="widget user-dashboard-profile">
                            <!-- User Image -->
                            <div class="profile-thumb">
                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->name ?? 'User' }}"
                                    class="rounded-circle">
                            </div>
                            <!-- User Name -->
                            <h5 class="text-center">{{ $user->name ?? 'User' }}</h5>
                            <p>Joined {{ date_format($user->created_at, 'd M, Y') }}</p>
                            <a href="{{ route('user.profile') }}" class="btn btn-main-sm">Edit Profile</a>
                        </div>
                        <!-- Dashboard Links -->
                        <div class="widget user-dashboard-menu">
                            <ul>
                                <li @if (Route::is('user.dashboard')) class="active" @endif><a
                                        href="{{ route('user.dashboard') }}"><i class="fa fa-user"></i> My Ads</a></li>
                                <li @if (Route::is('user.saved.ads')) class="active" @endif><a
                                        href="{{ route('user.saved.ads') }}"><i class="far fa-bookmark"></i> Favourite
                                        Ads</a></li>
                                <li @if (Route::is('user.pending.ads')) class="active" @endif><a
                                        href="{{ route('user.pending.ads') }}"><i class="fas fa-bolt"></i> Pending
                                        Approval</a></li>
                                <li @if (Route::is('user.rejected.ads')) class="active" @endif><a
                                        href="{{ route('user.rejected.ads') }}"><i class="fas fa-bolt"></i> Rejected </a>
                                </li>
                                <li @if (Route::is('user.archive.ads')) class="active" @endif><a
                                        href="{{ route('user.archive.ads') }}"><i class="far fa-file-archive"></i>Archived
                                        Ads</a></li>
                                <li @if (Route::is('user.messages')) class="active" @endif><a
                                        href="{{ route('user.messages') }}"><i class="fa fa-envelope"></i> Message
                                        Requests</a></li>
                                <li><a href="{{ route('logout') }}"><i class="fas fa-cog"></i> Logout</a></li>
                                {{-- <li><a href="#" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete
                                        Account</a></li> --}}
                            </ul>
                        </div>
                        <!-- delete-account modal -->
                        <!-- delete account popup modal start-->
                        <!-- Modal -->
                        {{-- <div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <form action="{{ route('user.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-bottom-0">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('images/account/Account1.png') }}" class="img-fluid mb-2" alt="">
                                            <h6 class="py-2">Are you sure you want to delete your account?</h6>
                                            <p>Do you really want to delete these records? This process cannot be undone.
                                            </p>
                                        </div>
                                        <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-lg-between justify-content-center">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                        <!-- delete account popup modal end-->
                        <!-- delete-account modal -->

                    </div>
                </div>
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                    <!-- Recently Favorited -->
                    <div class="widget dashboard-container my-adslist">
                        <h3 class="widget-header">{{ $title }}<span
                                class="text-primary">({{ $posts->total() }})</span></h3>
                        <table class="table table-responsive product-dashboard-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Title</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="product-thumb">
                                            <img width="80px"
                                                src="{{ asset('uploads/posts/' . $post->postImages->first()->image) }}"
                                                height="auto" src="" alt="image description">
                                        </td>
                                        <td class="product-details">
                                            <h3 class="title">{{ $post->title }}</h3>
                                            <span class="add-id"><strong>Ad ID:</strong>{{ $post->id }}</span>
                                            <span><strong>Posted on: </strong><time>Jun 27, 2017</time> </span>
                                            <span class="status active"><strong>Status</strong>{{ $post->status }}</span>
                                            <span
                                                class="location"><strong>Location</strong>{{ $post->postLocation() }}</span>
                                        </td>
                                        <td class="product-category"><span
                                                class="categories">{{ $post->category->name }}</span></td>
                                        <td class="action" data-title="Action">
                                            <div class="">
                                                <ul class="list-inline justify-content-center">
                                                    @if ($title == 'Archived Ads')

                                                    @elseif ($title == 'Favourite Ads')
                                                        <li class="list-inline-item">
                                                            <a data-toggle="tooltip" data-placement="top" title="view"
                                                                target="_blank" class="view" href="#">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li class="list-inline-item">
                                                            <a data-toggle="tooltip" data-placement="top" title="view"
                                                                target="_blank" class="view"
                                                                href="{{ route('posts.show', [$post, strtolower(str_replace(' ', '-', $post->title))]) }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a class="edit" data-toggle="tooltip" data-placement="top"
                                                                title="Edit" href="{{ route('posts.edit', $post) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a class="delete" data-toggle="tooltip" data-placement="top"
                                                                title="Delete"
                                                                href="{{ route('posts.destroy', $post) }}">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- pagination -->
                    <div class="pagination justify-content-center">
                        {{ $posts->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- pagination -->

                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
@endsection
