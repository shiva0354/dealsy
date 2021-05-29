@extends('layouts.adminlte')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">By : <a
                            href="{{ route('admin.users.show', $post->user) }}">{{ $post->user->name }}</a></h3>
                    <div class="card-tools">
                        <div class="row">
                            @if ($post->status == 'PENDING')
                                <div class="col">
                                    <form action="{{ route('admin.posts.status', [$post, 'active']) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-block btn-sm">Approve</button>
                                    </form>
                                </div>
                                <div class="col">
                                    <form action="{{ route('admin.posts.status', [$post, 'rejected']) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-block btn-sm">Reject Ad</button>
                                    </form>
                                </div>
                            @elseif($post->status == "ACTIVE")
                                <div class="col">
                                    <form action="{{ route('admin.posts.status', [$post, 'rejected']) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-block btn-sm">Reject Ad</button>
                                    </form>
                                </div>
                            @else
                                <div class="col">
                                    <form action="{{ route('admin.posts.status', [$post, 'active']) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-block btn-sm">Make Active</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-sm">
                            <tr>
                                <th scope="col">Ad Id</th>
                                <td>{{ $post->id }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Category</th>
                                <td>{{ $post->category->name }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Title</th>
                                <td>{{ $post->title }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Status</th>
                                <td>{{ $post->status }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Description</th>
                                <td>
                                    <p>{{ $post->detail }}</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Price</th>
                                <td>
                                    <p>₹ {{ $post->price }}/-</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Location</th>
                                <td>
                                    <p>{{ $post->postLocation() }}</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Posted Date</th>
                                <td>{{ date_format($post->created_at, 'd-M-Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Renewed On</th>
                                @if ($post->last_renewed_on)
                                    <td>{{ date_format($post->last_renewed_on, 'd-M-Y') }}</td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title"> <i class="fas fa-images"></i> Post Images</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($post->postImages as $image)
                            <div class="col-sm-2">
                                <a href="{{ asset('uploads/posts/' . $image->image) }}" data-toggle="lightbox"
                                    data-gallery="gallery">
                                    <img src="{{ asset('uploads/posts/' . $image->image) }}" class="img-fluid mb-2"
                                        alt="white sample">
                                </a>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        })

    </script>
@endsection
