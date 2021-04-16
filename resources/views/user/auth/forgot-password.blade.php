@extends('layouts.layout')
@section('title', 'Forgot Password')
@section('content')
    <section class="login py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 align-item-center">
                    <div class="border">
                        <h3 class="p-3 bg-gray" style="text-align: center; font-color:#888;">Reset Your Password</h3>
                        <p class="p-2">Enter your user account's verified email address and we will send you a password reset link.</p>
                        <form method="POST" action="{{route('password.email')}}">
                            @csrf
                            <fieldset class="p-3">
                                <input type="text" name="email" placeholder="Enter Email" class="border p-2 w-100 my-2">
                                <span style="color: red; font-weight:500;">@error('email'){{ $message }}
                                    @enderror</span><br>
                                <button type="submit" class="btn d-block bg-primary text-white border-0 rounded font-weight-bold mt-3 w-100">Send Password Reset Email</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer-call-to-action')
    @include('layouts.footer-main')
@endsection
