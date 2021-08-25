@extends('layouts.layout')
@section('title', 'Post Your Ad')
@section('content')
    <section class="bg-gray py-5">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <!-- Post Your ad start -->
                <fieldset class="border border-gary p-4 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Post Your ad</h3>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                @if ($post)
                                    <div class="col-md-12 my-2">
                                        <h6 class="font-weight-bold pt-4 pb-1">Select Ad Category:</h6>
                                        <select name="category" class="custom-select" id="main-category" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if (($post->category_id ?? '') == $category->id) selected @endif>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Select category</div>
                                    </div>
                                @else
                                    <div class="col-md-12 my-2">
                                        <h6 class="font-weight-bold pt-4 pb-1">Select Ad Category:</h6>
                                        <select name="category" class="custom-select" id="main-category" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if (($post->category_id ?? '') == $category->id) selected @endif>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Select category</div>
                                    </div>

                                    <div class="col-md-12 my-2">
                                        <h6 class="font-weight-bold pt-4 pb-1">Select Sub Category:</h6>
                                        <select name="sub_category" class="custom-select" id="category" required>
                                        </select>
                                        <div class="invalid-feedback">Select Sub Category</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-12 my-2">
                                    <h6 class="font-weight-bold pt-4 pb-1">Title Of Ad:</h6>
                                    <input type="text" name="title" class="border w-100 p-2 bg-white text-capitalize"
                                        pattern="[a-zA-Z0-9 ]{10,60}" placeholder="Ad title go There" required
                                        value="{{ old('title', $post->title ?? '') }}">
                                    <div class="invalid-feedback">Please enter Ad title. Minimum of 10 characters and
                                        maximum of 80 character</div>
                                </div>

                                <div class="col-md-12 my-2">
                                    <h6 class="font-weight-bold pt-4 pb-1">Set Price</h6>
                                    <input type="number" name="price" class="border w-100 p-2 bg-white"
                                        placeholder="Set Price" value="{{ old('price', $post->price ?? '') }}" required>
                                    <div class="invalid-feedback">Enter Price</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold pt-4 pb-1">Ad Description:</h6>
                            <textarea name="detail" id="detail" class="border w-100"
                                placeholder="Write details about your product" pattern="[*]{100,1000}"
                                required>{{ old('detail', $post->detail ?? '') }}</textarea>
                            <div class="invalid-feedback">Enter Ad details. Minimum of 100 character and maximum of 1000
                                character</div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold pt-4 pb-1">Location:</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <select name="state_id" class="custom-select" id="state">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" @if (($post->state_id ?? '') == $state->id) selected @endif>
                                                {{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Select City</div>
                                </div>
                                <div class="col-md-12 my-2">
                                    <select name="city_id" class="custom-select" id="city">
                                    </select>
                                    <div class="invalid-feedback">Select City</div>
                                </div>
                                <div class="col-md-12 my-2">
                                    <input type="text" name="locality" class="border w-100 p-2 bg-white text-capitalize"
                                        placeholder="Enter Locality" value="{{ old('locality', $post->locality ?? '') }}"
                                        required>
                                    <div class="invalid-feedback">Enter locality</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <!-- Post Your ad end -->
                <fieldset class="border p-4 my-5 seller-information bg-gray">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Product Images</h3>
                        </div>
                        <div class="choose-file mb-2 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file1"
                                    accept=".jpg, .jpeg, .png" required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file mb-2 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file2"
                                    accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file mb-2 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file3"
                                    accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file mb-2 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file4"
                                    accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file mb-2 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file5"
                                    accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file mb-2 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file6"
                                    accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file mb-2 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file7"
                                    accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file mb-2 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file8"
                                    accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                @if ($post)
                    <fieldset class="border p-4 my-5 seller-information bg-gray">
                        <div class="row">
                            @foreach ($post->postImages as $image)
                                <div class="col-md-3 mb-2" id="image{{ $image->id }}">
                                    <img src="{{ asset('uploads/posts/' . $image->image) }}" alt="" class="w-100"
                                        style="height: 150px;">
                                    <span class="badge-lg" style="position: absolute;top: -8px;right: 5px;"
                                        onclick="deleteImage({{ $post->id }},{{ $image->id }}); return false;"
                                        title="Delete Image"><i class="fas fa-times-circle fa-lg text-danger"></i></span>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                @endif
                <!-- submit button -->
                <div class="d-inline-flex">
                    <label for="terms-&-condition" class="ml-2">By posting you agree with our
                        <span><a class="text-success" href="{{ route('pages', 'terms') }}">Terms & Conditions</a> and <a
                                class="text-success" href="{{ route('pages', 'privacy') }}">Privacy.</a></span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary d-block mt-2">Post Your Ad</button>
            </form>
        </div>
    </section>

    @include('layouts.footer-main')

@endsection
@section('js-script')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
    <script>
        var categories = '';
        var cities = '';
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
        $(document).ready(function() {
            bsCustomFileInput.init()
        });

        $(function() {
            $("#main-category").change(function() {
                var categoryId = $("#main-category").val();
                let html = "";
                $.ajax({
                    type: "GET",
                    url: "/categories/" + categoryId,
                    data: {},
                    success: function(data) {
                        if (data) {
                            data.forEach(category => {
                                html += "<option value=" + category.id + ">" +
                                    category.name + "</option>";
                            });
                            $("#category").html(html);
                        }
                    }
                });
            });
        });

        $(function() {
            $("#state").change(function() {
                var cityId = $("#state").val();
                let cities = '';
                $.ajax({
                    type: "GET",
                    url: "/cities/" + cityId,
                    data: {},
                    success: function(data) {
                        if (data) {
                            data.forEach(city => {
                                cities += "<option value=" + city.id + ">" + city.name +
                                    "</option>";
                            });
                            $("#city").html(cities);
                        }
                    },
                });
            });
        });

        function deleteImage(postId, imageId) {
            $.ajax({
                type: "POST",
                url: `/posts/${postId}/images/${imageId}`,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#image' + imageId).hide();
                    alert(response);
                },
                error: function(jqXHR) {
                    msg = JSON.parse(jqXHR.responseText).message;
                    alert(msg);
                }
            });

        }
    </script>
@stop
