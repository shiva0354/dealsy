@extends('layouts.layout')
@section('title', 'Post Your Ad')
@section('content')

    <section class="bg-gray py-5">
        {{-- <script src="{!!  url('theme/plugins/ckeditor/ckeditor.js') !!}"></script>
        --}}
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
                            <h6 class="font-weight-bold pt-4 pb-1">Title Of Ad:</h6>
                            <input type="text" name="post_title" class="border w-100 p-2 bg-white text-capitalize"
                                placeholder="Ad title go There" required>
                               <div class="invalid-feedback">Please enter Ad title</div>

                            <h6 class="font-weight-bold pt-4 pb-1">Select Ad Category:</h6>
                            <div class="row">
                                <div class="col-lg-6 mr-lg-auto my-2">
                                    <select name="category_id" class="w-100" required>
                                        <option value="" hidden class="w-100" style="width: 100% !important;">Select
                                            category</option>
                                        @foreach (App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}" class="w-100"
                                                style="width: 100% !important;">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                <div class="invalid-feedback">Select Category</div>
                                </div>
                                <div class="col-lg-6 mr-lg-auto my-2">
                                    <select name="sub_category_id" class="w-100" style="width: 100% !important;">
                                        <option value="" hidden class="w-100">Sub category</option>
                                    </select>
                                </div>
                            </div>
                            <h6 class="font-weight-bold pt-4 pb-1">Ad Type:</h6>
                            <div class="row px-3">
                                <div class="col-lg-4 mr-lg-4 my-2 rounded bg-white">
                                    <input type="radio" name="ad_type" value="personal" id="personal" checked>
                                    <label for="personal" class="py-2">Personal</label>
                                </div>
                                <div class="col-lg-4 mr-lg-4 my-2 rounded bg-white ">
                                    <input type="radio" name="ad_type" value="business" id="business">
                                    <label for="business" class="py-2">Business</label>
                                </div>
                            </div>
                            <h6 class="font-weight-bold pt-4 pb-1">Location:</h6>
                            <input type="text" name="locality" class="border w-100 p-2 bg-white text-capitalize"
                                placeholder="Enter Locality" required>
                                <div class="invalid-feedback">Enter locality</div>
                            <div class="row">
                                <div class="col-lg-6 mr-lg-auto my-2">
                                    <input type="text" name="city" class="border w-100 p-2 bg-white text-capitalize"
                                        placeholder="Enter City" required>
                                        <div class="invalid-feedback">Enter city</div>
                                </div>
                                <div class="col-lg-6 mr-lg-auto my-2">
                                    <select name="state" id="state" class="w-100" required>
                                        <option value="">Select State</option>
                                        <option value="state">State</option>
                                        <option value="state1">Select State1</option>
                                        <option value="state2">Select State2</option>
                                        <option value="state3">Select State3</option>
                                        {{-- @foreach ($states as $state)
                                            <option value="{{$state}}">{{$state}}</option>
                                        @endforeach --}}
                                    </select>
                                    <div class="invalid-feedback">Select State</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="price">
                                <h6 class="font-weight-bold pt-4 pb-1">Item Price (₹ INR):</h6>
                                <div class="row px-3">
                                    <div class="col-lg-4 mr-lg-4 rounded bg-white my-2 ">
                                        {{-- <div class="form-group"> --}}
                                            <input type="text" name="expected_price" class="border-0 py-2 w-100 price"
                                            placeholder="Price" id="price" required>
                                            <div class="invalid-feedback">Enter your expected price</div>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="col-lg-4 rounded bg-white my-2 ">
                                        <select name="is_negotiable" id="state" class="w-100" required>
                                            <option value="">Is Negotiable</option>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                        </select>
                                        <div class="invalid-feedback">Select one</div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="font-weight-bold pt-4 pb-1">Ad Description:</h6>
                            <textarea name="post_detail" id="post_detail" class="border p-3 w-100" rows="7"
                                placeholder="Write details about your product" required></textarea>
                               <div class="invalid-feedback">Enter Ad details</div>
                            <script>
                                CKEDITOR.replace('post_detail');

                            </script>
                            <!--text editor end here-->
                        </div>
                    </div>
                </fieldset>
                <!-- Post Your ad end -->

                <!-- seller-information start -->
                <fieldset class="border p-4 my-5 seller-information bg-gray">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Product Images</h3>
                        </div>
                        <div class="choose-file my-4 py-4 rounded col-lg-3">
                            {{-- <label for="file-upload">
                                <span class="d-block font-weight-bold text-dark">Drop files anywhere to upload</span>
                                <span class="d-block">or</span>
                                <span class="d-block btn bg-primary text-white my-3 select-files">Select files</span>
                                <span class="d-block">Maximum upload file size: 500 KB</span>
                                <input type="file" class="form-control-file d-none" id="file-upload" name="file">
                            </label> --}}
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file1" accept=".jpg, .jpeg, .png" required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file my-4 py-4 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file2" accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file my-4 py-4 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file3" accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file my-4 py-4 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file4" accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file my-4 py-4 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file5" accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file my-4 py-4 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file6" accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file my-4 py-4 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file7" accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                        <div class="choose-file my-4 py-4 rounded col-lg-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="file8" accept=".jpg, .jpeg, .png">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Only jpeg,jpg,png allowed.Maximum upload file size: 1 MB</div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <!-- seller-information end-->

                <!-- ad-feature start -->
                {{-- <fieldset class="border bg-white p-4 my-5 ad-feature bg-gray">
                    <div class="row">
                        <div class="col-lg-12">

                            <h3 class="pb-3">Make Your Ad Featured
                                <span class="float-right"><a class="text-right font-weight-normal text-success"
                                        href="#">What
                                        is featured ad ?</a></span>
                            </h3>

                        </div>
                        <div class="col-lg-6 my-3">
                            <span class="mb-3 d-block">Premium Ad Options:</span>
                            <ul>
                                <li>
                                    <input type="radio" id="regular-ad" name="adfeature">
                                    <label for="regular-ad" class="font-weight-bold text-dark py-1">Regular Ad</label>
                                    <span>$00.00</span>
                                </li>
                                <li>
                                    <input type="radio" id="Featured-Ads" name="adfeature">
                                    <label for="Featured-Ads" class="font-weight-bold text-dark py-1">Top Featured
                                        Ads</label>
                                    <span>$59.00</span>
                                </li>
                                <li>
                                    <input type="radio" id="urgent-Ads" name="adfeature">
                                    <label for="urgent-Ads" class="font-weight-bold text-dark py-1">Urgent Ads</label>
                                    <span>$79.00</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6 my-3">
                            <span class="mb-3 d-block">Please select the preferred payment method:</span>
                            <ul>
                                <li>
                                    <input type="radio" id="bank-transfer" name="adfeature">
                                    <label for="bank-transfer" class="font-weight-bold text-dark py-1">Direct Bank
                                        Transfer</label>
                                </li>
                                <li>
                                    <input type="radio" id="Cheque-Payment" name="adfeature">
                                    <label for="Cheque-Payment" class="font-weight-bold text-dark py-1">Cheque
                                        Payment</label>
                                </li>
                                <li>
                                    <input type="radio" id="Credit-Card" name="adfeature">
                                    <label for="Credit-Card" class="font-weight-bold text-dark py-1">Credit Card</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </fieldset> --}}
                <!-- ad-feature start -->

                <!-- submit button -->
                <div class="checkbox d-inline-flex">
                    <input type="checkbox" id="terms-&-condition" class="mt-1" required>
                    <label for="terms-&-condition" class="ml-2">By click you must agree with our
                        <span><a class="text-success" href="{{route('terms')}}">Terms & Conditions</a> and <a class="text-success" href="{{route('privacy')}}">Privacy.</a></span>
                    </label>
                </div>
                    <div class="invalid-feedback">Please check</div>
                <button type="submit" class="btn btn-primary d-block mt-2">Post Your Ad</button>
            </form>
        </div>
    </section>

    @include('layouts.footer-main')

@endsection
@section('js-script')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.min.js"></script>
    <script src="//cdn.ckeditor.com/4.15.0/basic/ckeditor.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        $(document).ready(function () {
            bsCustomFileInput.init()

            $(".slug-source").bind("propertychange keyup input cut paste", function (event) {
                let slugId = $(this).data('slug-sink');

                let slug = $("#" + slugId);
                if (slug) {
                    let text = slugify($(this).val());
                    slug.val(text);
                }
            });
        });
    </script>
@stop
