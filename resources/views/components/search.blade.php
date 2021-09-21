<style>
    .select2-selection__rendered {
        line-height: 48px !important;
    }

    .select2-container .select2-selection--single {
        height: 48px !important;
    }

    .select2-selection__arrow {
        height: 48px !important;
    }

</style>

<div class="advance-search">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('search') }}" method="GET">
                    <div class="row">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="query" class="sr-only">Category</label>
                                {{-- <select class="select2_title" name="query" id="query" required style="width: 250px;">
                                    <option value="">What are you looking for?</option>
                                </select> --}}
                                <input type="text" class="form-control" placeholder="What are you looking for?"
                                    name="query">
                            </div>
                        </div>
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="category" class="sr-only">Category</label>
                                <select class="select2_category form-control" name="category" id="category">
                                    <option value="">--Select Category--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="location" class="sr-only">Location</label>
                                <select class="select2_location form-control" name="location" id="location">
                                    <option value="">--Select Location--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="location" class="sr-only">Search</label>
                                <button type="submit" class="btn btn-block btn-sm btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('js-script')
    <script>
        $(".select2_category").select2({
            width: 'resolve',
            ajax: {
                url: "{{ route('ajax.categories') }}",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        $(".select2_location").select2({
            width: 'resolve',
            ajax: {
                url: "{{ route('ajax.cities') }}",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        // $(".select2_title").select2({
        //     width: 'resolve',
        //     ajax: {
        //         url: "{{ route('ajax.post.titles') }}",
        //         type: "post",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function(params) {
        //             return {
        //                 _token: "{{ csrf_token() }}",
        //                 search: params.term
        //             };
        //         },
        //         processResults: function(response) {
        //             return {
        //                 results: $.map(response, function(item) {
        //                     return {
        //                         text: item.text,
        //                         id: item.text
        //                     }
        //                 }),
        //             };
        //         },
        //         cache: true
        //     }
        // });
    </script>
@endsection
