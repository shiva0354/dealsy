@extends('layouts.adminlte')

@section('title', 'SeoTool List')

@section('content_header')
    <div class="row align-items-center">
        <div class="col text-left">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.seo-tools.index') }}">SeoTools</a></li>
            </ol>
        </div>
        <div class="col text-right">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.seo-tools.default') }}">Default Seo</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title text-lg">SeoTool List</div>
            <div class="card-tools mr-0">
                <a class="btn btn-sm btn-outline-success" href="{{ route('admin.seo-tools.create') }}">Create SeoTool</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover">
                <thead class="text-sm">
                    <tr>
                        <th class="">S No.</th>
                        <th class="">Url</th>
                        <th class="">Meta Title</th>
                        <th class="">Meta Description</th>
                        <th class="">Og Title</th>
                        <th class="">Og Description</th>
                        <th class="">Twitter Title</th>
                        <th class="">Twitter Description</th>
                        <td>&nbsp;</td>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($seoTools as $seoTool)
                        <tr>
                            <td class="">{{ $seoTool->id }}</td>
                            <td class="">{{ $seoTool->url }}</td>
                            <td class="">{{ $seoTool->meta_title }}</td>
                            <td class="">{{ $seoTool->meta_description }}</td>
                            <td class="">{{ $seoTool->og_title }}</td>
                            <td class="">{{ $seoTool->og_description }}</td>
                            <td class="">{{ $seoTool->twitter_title }}</td>
                            <td class="">{{ $seoTool->twitter_description }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.seo-tools.show', $seoTool) }}" class="text-primary"><i
                                            class="fas fa-eye pl-3"></i></a>
                                    <a href="{{ route('admin.seo-tools.edit', $seoTool) }}" class="text-primary"><i
                                            class="fas fa-edit pl-3"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- // pagination --}}
    <div class="row justify-content-center">
        {{ $seoTools->links('pagination::bootstrap-4') }}
    </div>
@stop
