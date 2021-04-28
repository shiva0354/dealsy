<div class="advance-search">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <form method="GET" action="{{ route('search') }}">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" 
                                placeholder="What are you looking for" name="query" required>
                        </div>
                        <div class="form-group col-md-3">
                            <select class="form-control select-category" name="category" required>
                                @foreach (App\Models\Category::whereNull('parent_id')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" autocomplete="off" id="location" onkeyup="locationAutocomplete()"
                                placeholder="Location" name="location" required>
                        </div>
                        <div class="form-group col-md-2 align-self-center">
                            <button type="submit" class="btn btn-primary">Search Now</button>
                        </div>                            
                        <div class="input-group input_container">
                                <ul id="location_list" style="display: none;"></ul>
                            </div>
                    </div>
                </form> --}}
                <form action="{{ $action }}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="text" class="form-control" placeholder="What are you looking for" name="query" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <select class="custom-select form-control" name="category" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="text" class="form-control" autocomplete="off" id="location" onkeyup="locationAutocomplete()" placeholder="Location" name="location" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="submit" class="btn btn-block btn-sm btn-primary" value="Search">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('js-script')
    <script type="text/javascript">
        <!--
        function locationAutocomplete() {
            var min_length = 0; // min caracters to display the autocomplete
            var keyword = $('#location').val();
            if (keyword.length >= min_length) {
                $.ajax({
                    url: "{{ route('ajax.location') }}",
                    type: 'GET',
                    data: {
                        keyword: keyword,
                        action: 'location'
                    },
                    success: function(data) {
                        console.log(data);
                        $('#location_list').show();
                        $('#location_list').html(data);
                    }
                });
            } else {
                $('#location_list').hide();
            }
        }

        function set_item(item) {
            $('#location').val(item);
            $('#location_list').hide();
        }
        $(document).ready(function() {
            $('.numeric').on('input', function(event) {
                this.value = this.value.replace(/[^.0-9]/g, '');
            });
        });
        //

        -->
    </script>
@endsection
