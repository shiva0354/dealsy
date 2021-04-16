@extends('layouts.layout')
@section('title', 'Reset Password')
@section('content')
    <section class="login py-5 border-top-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 align-item-center">
                    <div class="border border">
                        <h3 class="bg-gray p-4">Reset Password</h3>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <fieldset class="p-4">
                                <input type="hidden" name="token" value="{{ $token }}" class="border p-3 w-100 my-2">
                                <input type="email" name="email" placeholder="Eamil" class="border p-3 w-100 my-2 mb-4" value="{{ $email }}" readonly>
                                <input type="password" name="password" placeholder="Password*" class="border p-3 w-100 my-2 mb-4">
                                <span class="mb-4" style="color: red;">@error('password'){{ $message }} @enderror</span>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password*" class="border p-3 w-100 my-2 mb-2">
                                <button type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold w-100">Reset Password</button>
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
