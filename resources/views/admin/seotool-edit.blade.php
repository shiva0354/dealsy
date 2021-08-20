@extends('layouts.adminlte')

@section('title', $seoTool ? 'Update SeoTool' : 'Create SeoTool')

@section('content_header')
    <div class="row align-items-center">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.seo-tools.index')}}">SeoTools</a></li>
                @if($seoTool)
                    <li class="breadcrumb-item"><a href="{{route('admin.seo-tools.show', $seoTool)}}">{{ $seoTool->id }}</a></li>
                    <li class="breadcrumb-item active">Edit SeoTool</li>
                @else
                    <li class="breadcrumb-item active">Create SeoTool</li>
                @endif
            </ol>
        </div>
        <div class="col text-right">
        </div>
    </div>
@stop

@section('content')
    <form method="post" class="needs-validation" novalidate autocomplete="off" action="{{ $action }}">
        @if ($seoTool) @method('PUT') @endif
        @csrf
        <input type="hidden" name="_referrer" value="{{ $referrer }}">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg">{{ $seoTool ? 'Edit SeoTool' : 'Create SeoTool' }}</div>
                <div class="text-right">
                    <input type="reset" value="Reset" class="btn btn-sm btn-outline-warning">
                </div>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul class="py-0 my-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <x-adminlte-input name="url" label="Url" disable-feedback required
                                      value="{{ old('url', $seoTool->url ?? '') }}"
                                      label-class="text-sm" fgroup-class="col-sm-6 col-lg-4 col-xl-6">
                    </x-adminlte-input>
                    <x-adminlte-input name="meta_title" label="Meta Title" disable-feedback required
                                      value="{{ old('meta_title', $seoTool->meta_title ?? '') }}"
                                      label-class="text-sm" fgroup-class="col-sm-6 col-lg-4 col-xl-6">
                    </x-adminlte-input>
                    <x-adminlte-textarea name="meta_description" label="Meta Description" disable-feedback required
                                      value="{{ old('meta_description', $seoTool->meta_description ?? '') }}"
                                      label-class="text-sm" fgroup-class="col-sm-6 col-lg-4 col-xl-6">
                    </x-adminlte-textarea>
                    <x-adminlte-input name="og_title" label="Og Title" disable-feedback required
                                      value="{{ old('og_title', $seoTool->og_title ?? '') }}"
                                      label-class="text-sm" fgroup-class="col-sm-6 col-lg-4 col-xl-6">
                    </x-adminlte-input>
                    <x-adminlte-textarea name="og_description" label="Og Description" disable-feedback required
                                      value="{{ old('og_description', $seoTool->og_description ?? '') }}"
                                      label-class="text-sm" fgroup-class="col-sm-6 col-lg-4 col-xl-6">
                    </x-adminlte-textarea>
                    <x-adminlte-input name="twitter_title" label="Twitter Title" disable-feedback required
                                      value="{{ old('twitter_title', $seoTool->twitter_title ?? '') }}"
                                      label-class="text-sm" fgroup-class="col-sm-6 col-lg-4 col-xl-6">
                    </x-adminlte-input>
                    <x-adminlte-textarea name="twitter_description" label="Twitter Description" disable-feedback required
                                      value="{{ old('twitter_description', $seoTool->twitter_description ?? '') }}"
                                      label-class="text-sm" fgroup-class="col-sm-6 col-lg-4 col-xl-6">
                    </x-adminlte-textarea>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-4">
                        <a class="btn btn-link pl-0" href="{{ $referrer }}">&laquo; Back</a>
                    </div>
                    <div class="col-sm-4 text-center">
                    </div>
                    <div class="col-sm-4 text-right">
                        <input type="submit" value="{{ $seoTool ? 'Update SeoTool' : 'Create SeoTool' }}" class="btn btn-info">
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('js')
    @include('scripts.form-validate')
    @include('scripts.form-slugify')
@endpush
