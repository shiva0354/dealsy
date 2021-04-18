@extends('layouts.adminlte')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">All categories</h1>
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
                        @if ($singleCategory) @method('PUT') @endif
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="name" class="mb-2 mr-sm-2">Category Name</label>
                                <input type="text" class="form-control mb-2 mr-sm-5" id="name" name="name" placeholder="Enter Category Name" value="{{ old('name', $singleCategory->name ?? '') }}"
                                    required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="slug" class="mb-2 mr-sm-2">Category Slug</label>
                                <input type="text" class="form-control mb-2 mr-sm-5" id="slug" name="slug" placeholder="Enter Category Slug" value="{{ old('slug', $singleCategory->slug ?? '') }}"
                                    required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="model" class="mb-2 mr-sm-2">Icon (Fontawesome)</label>
                                <input type="text" class="form-control mb-2 mr-sm-5" id="model" name="model" placeholder="Enter Category Icon" value="{{ old('icon', $singleCategory->icon ?? '') }}"
                                    required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="type" class="mb-2 mr-sm-2">Parent Category</label>
                                <select name="type" id="type" class="form-control custom-select">
                                    @foreach ($categories->whereNull('parent_id') as $category)
                                        <option value="{{ $category->id }}" @if (($singleCategory->parent_id ?? '') == $category->id) selected @endif>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="submit" class="mb-2 mr-sm-2">&nbsp;</label>
                                <input type="submit" class="form-control mb-2 mr-sm-2 btn btn-info" value="{{ $singleCategory ? 'Update' : 'Add  New Category' }}">
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
                                <th scope="col">Icon</th>
                                <th scope="col">Parent</th>
                                <th scope="col" class="min-w-200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td><i class="{{ $category->icon }}"></i></td>
                                    <td>{{ $category->parent->name ?? '' }}</td>
                                    <td class="td-actions-1">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn text-primary"><i class="fas fa-edit"></i> Edit</a>
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
        {{ $categories->links('pagination::bootstrap-4') }}
    </div>
@stop
