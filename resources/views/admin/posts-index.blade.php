@extends('layouts.adminlte')

@section('content_header')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Filters</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body pt-4 pb-4" style="align-content: center;">
                    <form action="" method="get" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="form-group col-sm-2">
                                <label for="category" class="mb-2 mr-sm-2">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="">All</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if (request()->get('category') == $category->id) selected="selected" @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="search" class="mb-2 mr-sm-2">Locality</label>
                                <input type="text" name="locality" id="locality" class="form-control mb-2 mr-sm-5"
                                    placeholder="Locality" value="{{ request()->get('locality') ?? '' }}">
                            </div>

                            <div class="form-group col-sm-2">
                                <label for="location" class="mb-2 mr-sm-2">City</label>
                                <select class="form-control" id="location" name="location">
                                    <option value="">All</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" @if (request()->get('location') == $location->id) selected="selected" @endif>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="status" class="mb-2 mr-sm-2">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="PENDING" @if (request()->get('status') == 'PENDING') selected="selected" @endif>PENDING</option>
                                    <option value="REJECTED" @if (request()->get('status') == 'REJECTED') selected="selected" @endif>REJECTED</option>
                                    <option value="ACTIVE" @if (request()->get('status') == 'ACTIVE') selected="selected" @endif>ACTIVE</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="submit" class="mb-2 mr-sm-2">&nbsp;</label>
                                <input type="submit" class="form-control mb-2 mr-sm-2 btn btn-info" value="Go">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Ad Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Posted Date</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td><img src="{{ asset('uploads/posts/' . $post->postImages->first()->image) }}"
                                                alt="" style="width: 80px;"></td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td><a
                                                href="{{ route('admin.users.show', $post->user) }}">{{ $post->user->name }}</a>
                                        </td>
                                        <td>{{ $post->status }}</td>
                                        <td>{{ date_format($post->created_at, 'd/M/Y') }}</td>
                                        <td><a href="{{ route('admin.posts.show', $post) }}"><i class="fas fa-eye"></i></a>
                                        </td>
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

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // $('#post-datatable').DataTable({
            //     lengthMenu: [
            //         [10, 25, 50, 100, -1],
            //         [10, 25, 50, 100, "All"]
            //     ],
            // });

            $('#category').select2();
            $('#location').select2();
        });

    </script>
@stop
