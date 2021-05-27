@extends('layouts.adminlte')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">All Location</h1>
        </div>
        <div class="col-md-6">
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body pt-4 pb-4" style="align-content: center;">
                    @if ($errors->any())
                        <div class="alert alert-warning p-0">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ $action }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @if ($singleLocation) @method('PUT') @endif
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="name" class="mb-2 mr-sm-2">Location Name</label>
                                <input type="text" class="form-control mb-2 mr-sm-5" id="name" name="name" placeholder="Enter Location Name"
                                    value="{{ old('name', $singleLocation->name ?? '') }}" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="slug" class="mb-2 mr-sm-2">Location Slug</label>
                                <input type="text" class="form-control mb-2 mr-sm-5" id="slug" name="slug" placeholder="Enter Location Slug" value="{{ old('slug', $singleLocation->slug ?? '') }}"
                                    required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="parent_id" class="mb-2 mr-sm-2">Parent Location</label>
                                <select name="parent_id" id="parent_id" class="form-control custom-select">
                                    @foreach ($locations->whereNull('parent_id') as $location)
                                        <option value="{{ $location->id }}" @if (($singleLocation->parent_id ?? '') == $location->id) selected @endif>
                                            {{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="submit" class="mb-2 mr-sm-2">&nbsp;</label>
                                <input type="submit" class="form-control mb-2 mr-sm-2 btn btn-info" value="{{ $singleLocation ? 'Update' : 'Add  New Location' }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-valign-middle">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Parent</th>
                                <th scope="col" class="min-w-200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                                <tr>
                                    <td>{{ $location->name }}</td>
                                    <td>{{ $location->slug }}</td>
                                    <td>{{ $location->state->name ?? '' }}</td>
                                    <td class="td-actions-1">
                                        <a href="{{ route('admin.locations.edit', $location) }}" class="btn text-primary"><i class="fas fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- // pagination --}}
    <div class="row justify-content-center">
        {{ $locations->links('pagination::bootstrap-4') }}
    </div>
@stop
