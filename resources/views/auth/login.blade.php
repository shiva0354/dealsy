@extends('layouts.layout')
@section('title', 'Login')
@section('content')
    <section class="login py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 align-item-center">
                    <div class="border">
                        <h3 class="p-3 bg-gray" style="text-align: center; font-color:#888;">Sign in with your social media
                            account</h3>
                        <div class="col">
                            <a href="{{ route('social.login', 'facebook') }}" class="fb btn">
                                <i class="fa fa-facebook fa-fw"></i> Facebook
                            </a>
                            <a href="{{ route('social.login', 'google') }}" class="google btn">
                                <i class="fa fa-google fa-fw"></i> Google
                            </a>
                        </div>
                        <div class="ml-3 mr-3 or-seperator"><b>or</b></div>
                        <form method="POST">
                            @csrf
                            <fieldset class="p-3">
                                <input type="text" name="email" placeholder="Enter Email"
                                    class="border p-2 w-100 my-2 mb-2">
                                <span class="mb-2" style="color: red; font-weight:500;">@error('email'){{ $message }}
                                    @enderror</span>
                                <input type="password" name="password" placeholder="Enter Password"
                                    class="border p-2 w-100 my-2 mb-2">
                                <span class="mb-2" style="color: red; font-weight:500;">@error('password'){{ $message }}
                                    @enderror</span>
                                {{-- <div class="loggedin-forgot">
                                    <input type="checkbox" id="keep-me-logged-in">
                                    <label for="keep-me-logged-in" class="pt-3 pb-2">Keep me logged in</label>
                                </div> --}}
                                <button type="submit"
                                    class="btn d-block bg-primary text-white border-0 rounded font-weight-bold mt-3">Log
                                    in</button>
                                <div class="col">
                                    <a class="mt-3 d-block  text-primary float-left"
                                        href="{{ route('forgot.password') }}">Forget Password?</a>
                                    <a class="mt-3 d-inline-block text-primary float-right"
                                        href="{{ route('signup') }}">Register Now</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            margin: 5px 0;
            opacity: 0.85;
            display: inline-block;
            font-size: 17px;
            line-height: 20px;
            text-decoration: none;
            /* remove underline from anchors */
        }

        input:hover,
        .btn:hover {
            opacity: 1;
        }

        .fb {
            background-color: #3B5998;
            color: white;
        }

        .twitter {
            background-color: #55ACEE;
            color: white;
        }

        .google {
            background-color: #dd4b39;
            color: white;
        }

        .or-seperator {
            margin-top: 32px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }

        .or-seperator b {
            color: #666;
            padding: 0 8px;
            width: 30px;
            height: 30px;
            font-size: 13px;
            text-align: center;
            line-height: 26px;
            background: #fff;
            display: inline-block;
            border: 1px solid #e0e0e0;
            border-radius: 50%;
            position: relative;
            top: -15px;
            z-index: 1;
        }

    </style>
    @include('layouts.footer-call-to-action')
    @include('layouts.footer-main')
@endsection
