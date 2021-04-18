@extends('layouts.adminlte')

@section('content_header')
    <h1 class="m-0 text-dark">{{ $admin ? 'Edit admin' : 'Add New admin' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data" action="{{ $action }}">
                @if ($admin) @method('PUT') @endif
                @csrf

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name" class="text-sm">Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Name" value="{{ old('name', $admin->name ?? '') }}" required>
                            <div class="invalid-feedback">Name is required</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email" class="text-sm">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-sm" pattern="[A-Za-z0-9@.]{5,255}" placeholder="Email"
                                value="{{ old('email', $admin->email ?? '') }}" @if ($admin) readonly @else required @endif>
                            <div class="invalid-feedback">Enter valid email</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="mobile" class="text-sm">Mobile</label>
                            <input type="tel" name="mobile" id="mobile" class="form-control form-control-sm" placeholder="Mobile" value="{{ old('mobile', $admin->mobile ?? '') }}" required>
                            <div class="invalid-feedback">Mobile is required</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="designation" class="text-sm">Enabled</label>
                            <select type="text" name="enabled" id="role" class="form-control form-control-sm custom-select" required>
                                <option value="">Status</option>
                                <option value="1" @if (($admin->enabled ?? '') == '1') selected @endif>YES</option>
                                <option value="0" @if (($admin->enabled ?? '') == '0') selected @endif>NO</option>
                            </select>
                            <div class="invalid-feedback">Choose active status of the admin</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="role" class="text-sm">Select Role</label>
                            <select type="text" name="role" id="role" class="form-control form-control-sm custom-select" required>
                                <option value="">Select Role</option>
                                @if (Route::is(['admin.admins.edit', 'admin.admins.create']))
                                    <option value="SUPER ADMIN" @if (($admin->role ?? '') == 'SUPER ADMIN') selected @endif>SUPER ADMIN</option>
                                    <option value="ADMIN" @if (($admin->role ?? '') == 'ADMIN') selected @endif>ADMIN</option>
                                    <option value="EMPLOYEE" @if (($admin->role ?? '') == 'EMPLOYEE') selected @endif>EMPLOYEE</option>
                                @endif
                            </select>
                            <div class="invalid-feedback">Choose admin role</div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="{{ $admin ? 'Update Details' : 'Add  New admin' }}" class="btn btn-info btn-block">
            </form>
        </div>
    </div>
@stop


@push('js')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

    </script>
@endpush
