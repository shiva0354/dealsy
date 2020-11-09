@extends('layout')
@section('content')
<section class="login py-5 border-top-1">    
    <div class="container">       
        <div class="row justify-content-center">
            @if (session('user'))
            <div class="alert alert-warning font-weight-bold" role="alert">
                {{session('user')}}
            </div>    
            @endif
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border border">
                    <h3 class="bg-gray p-4">Register Now</h3>
                   {{-- @if ($errors->any())
                       @foreach ($errors->all() as $err)
                           <li>{{$err}}</li>
                       @endforeach                     
                   @endif --}}
                    <form action="{{ route('user.signup') }}" method="POST">
                        @csrf
                        <fieldset class="p-4">
                            <input type="text" name="email" placeholder="Email*" class="border p-3 w-100 my-2">
                            <br>
                            <span style="color: red;">@error('email'){{$message}} @enderror</span>
                                <br>                           
                            <input type="password" name="password" placeholder="Password*" class="border p-3 w-100 my-2">
                            <br>
                            <span style="color: red;">@error('password'){{$message}} @enderror</span>
                                <br> 
                            <input type="password" name="password_confirmation" placeholder="Confirm Password*" class="border p-3 w-100 my-2">
                            <div class="loggedin-forgot d-inline-flex my-3">
                                    <input type="checkbox" id="registering" class="mt-1">
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
@endsection