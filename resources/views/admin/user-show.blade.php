@extends('layouts.adminlte')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Posted Date</th>
                                    <th scope="col">Renewed At</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td><img src="{{ asset('uploads/posts/' . $post->postImages->first()->image) }}"
                                                alt="" style="width: 80px;"></td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->status }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->last_renewed_on }}</td>
                                        <td><a href="#"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- // pagination --}}
    <div class="row justify-content-center">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
@stop
