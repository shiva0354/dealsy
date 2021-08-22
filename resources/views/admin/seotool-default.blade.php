@extends('layouts.adminlte')

@section('title', 'Seo Default')

@section('content_header')
    <div class="row align-items-center">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.seo-tools.default') }}">Default Seo</a></li>
            </ol>
        </div>
        <div class="col text-right">
        </div>
    </div>
@stop

@section('content')
    <form method="post" class="needs-validation" novalidate autocomplete="off" action="{{ $action }}">
        @csrf
        <input type="hidden" name="_referrer" value="{{ $referrer }}">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg">SeoTool Default</div>
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

                    @forelse (config('seo') as $key=>$seo)
                        <x-adminlte-input name="{{ $key }}" label="{{ ucwords($key) }}" disable-feedback required
                            value="{{ old('url', $seo ?? '') }}" label-class="text-sm"
                            fgroup-class="col-sm-12 col-lg-12 col-xl-12">
                        </x-adminlte-input>

                    @empty

                    @endforelse

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
                        <input type="submit" value="Update SeoTool" class="btn btn-info">
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
