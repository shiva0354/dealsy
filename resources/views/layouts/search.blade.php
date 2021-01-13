<section class="page-search">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Advance Search -->
                <div class="advance-search">
                    <form method="GET" action="{{ route('search') }}">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control my-2 my-lg-1" id="inputtext4"
                                    placeholder="What are you looking for" name="query" required>
                            </div>
                            <div class="form-group col-md-3">
                                <select class="w-100 form-control mt-lg-1 mt-md-2" name="category" required>
                                    <option value="" hidden>Category</option>
                                    @foreach (App\Models\Category::whereNull('parent_id')->get() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control my-2 my-lg-1" id="inputLocation4"
                                    placeholder="Location" name="location" required>
                            </div>
                            <div class="form-group col-md-2 align-self-center">
                                <button type="submit" class="btn btn-primary">Search Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
