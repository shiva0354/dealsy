@extends('layouts.layout')
@section('title', 'Sign Up')
@section('content')
<section class="login py-5 border-top-1">    
    <div class="container">       
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border border">
                    <h3 class="bg-gray p-4">Register Now</h3>
                    <form method="POST">
                        @csrf
                        <fieldset class="p-4">
                            <input type="text" name="name" placeholder="Name" class="border p-3 w-100 my-2 mb-2">
                            <input type="text" name="email" placeholder="Email*" class="border p-3 w-100 my-2 mb-2">
                            <span class="mb-2" style="color: red;">@error('email'){{$message}} @enderror</span>        
                            <input type="password" name="password" placeholder="Password*" class="border p-3 w-100 my-2 mb-2">
                            <span class="mb-2" style="color: red;">@error('password'){{$message}} @enderror</span>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password*" class="border p-3 w-100 my-2 mb-2">
                            <div class="loggedin-forgot d-inline-flex my-3">
                                    <label for="registering" class="px-2">By registering, you accept our <a class="text-primary font-weight-bold" href="terms-condition.html">Terms & Conditions</a></label>
                            </div>
                            <button type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold w-100">Register Now</button>
                            <a class="mt-3 d-inline-block text-primary" href="{{route('login')}}">Already have an account! Login now</a>
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