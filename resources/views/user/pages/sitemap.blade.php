@extends('layouts.layout')
@section('title', 'Error 404')
@section('content')
    <section class="section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center mx-auto">
                    <div class="404-img">
                        <img src="{{ asset('theme/images/404/404.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="404-content">
                        <h1 class="display-1 pt-1 pb-2">SiteMap</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us end -->
    @include('layouts.footer-call-to-action')
    @include('layouts.footer-main')
@endsection
