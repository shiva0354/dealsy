@extends('layouts.adminlte')

@section('title', 'SeoTool Details')

@section('content_header')
    <div class="row align-items-center">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.seo-tools.index')}}">SeoTools</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.seo-tools.show', $seoTool)}}">{{ $seoTool->id }}</a></li>
            </ol>
        </div>
        <div class="col text-right">
        </div>
    </div>
@stop

@section('content')
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg">SeoTool Details</div>
                <div class="card-tools mr-0">
                    <a class="btn btn-sm btn-outline-primary" href="{{route('admin.seo-tools.edit', $seoTool)}}">Edit SeoTool</a>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover">
                    <tr><td>Url</td><td>{{ $seoTool->url }}</td></tr>
                    <tr><td>Meta Title</td><td>{{ $seoTool->meta_title }}</td></tr>
                    <tr><td>Meta Description</td><td>{{ $seoTool->meta_description }}</td></tr>
                    <tr><td>Og Title</td><td>{{ $seoTool->og_title }}</td></tr>
                    <tr><td>Og Description</td><td>{{ $seoTool->og_description }}</td></tr>
                    <tr><td>Twitter Title</td><td>{{ $seoTool->twitter_title }}</td></tr>
                    <tr><td>Twitter Description</td><td>{{ $seoTool->twitter_description }}</td></tr>
                </table>
            </div>
        </div>
    </div>
@stop
