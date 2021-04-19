@extends('layouts.adminlte')

@section('content_header')
    <h1 class="m-0 text-dark">Change Password</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mx-auto" style="max-width: 400px">
                        @if ($errors->any())
                            <div class="alert alert-warning">
                                @foreach ($errors->all() as $error)
                                    <div class="text-center m-0">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <form method="post" class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="text-sm">Current Password</label>
                                <input type="password" name="old_password" id="old_password" class="form-control form-control-sm" placeholder="Current Password" required>
                                <div class="invalid-feedback">Current password is required</div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-sm">New Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Enter New Password" required>
                                <div class="invalid-feedback">Please enter new password</div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="text-sm">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm" placeholder="Confirm Password" required>
                                <div class="invalid-feedback">Password must match</div>
                            </div>
                            <input type="submit" value="Update Password" class="btn btn-info btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
