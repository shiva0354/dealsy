@extends('layouts.layout')
@section('title', 'Contact Us')
@section('content')
    <!-- page title -->
    <x-page-heading title="Contact Us" />
    <!-- //page title -->
    <!-- contact us start-->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-us-content p-4">
                        <h5>Contact Us</h5>
                        <h1 class="pt-3">Hello, what's on your mind?</h1>
                        <p class="pt-3 pb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elit dolor,
                            blandit vel euismod ac, lentesque et dolor. Ut id tempus ipsum.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <form method="POST">
                        @csrf
                        <fieldset class="p-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 py-2">
                                        <input type="text" name="name" placeholder="Name *" class="form-control" />
                                        <span class="" style="color: red;">@error('name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-lg-6 pt-2">
                                        <input type="email" name="email" placeholder="Email *" class="form-control" />
                                        <span class="" style="color: red;">@error('email'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                            </div>
                            <textarea name="message" id="" placeholder="Message *"
                                class="border w-100 p-3 mt-3 mt-lg-4"></textarea>
                            <span class="" style="color: red;">@error('message'){{ $message }}@enderror</span>
                            <div class="btn-grounp">
                                <button type="submit" class="btn btn-primary mt-2 float-right">SUBMIT</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us end -->
    @include('layouts.footer-call-to-action')
    @include('layouts.footer-main')
@endsection
