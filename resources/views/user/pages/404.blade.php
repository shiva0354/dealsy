@extends('layouts.layout')
@section('title', 'Error 404')
@section('content')
    <section class="section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-center">
                    <div class="404-img">
                        <img src="{{ asset('theme/images/404/404.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="404-content">
                        <h1 class="display-1 pt-1 pb-2">Oops</h1>
                        <p class="px-3 pb-2 text-dark">Something went wrong,we can't find the page that you are looking for :(But there is a lot more for you!</p>
                        <a href="{{ route('home') }}" class="btn btn-info">GO HOME</a>
                    </div>
                </div>
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-4">
                    <div class="mb-2 text-center">
                        <span class="text-primary" style="font-size: 18pt;">Please enter the Name and Email. We will get in touch with you soon!</span>
                    </div>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="name"><b>Email</b></label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us end -->
    @include('layouts.footer-call-to-action')
    @include('layouts.footer-main')
@endsection
