<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Library\AdminAuthGuard;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    use AdminAuthGuard;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Category::all();
        $categories = Category::with('parent')->orderBy('parent_id')->paginate(50);
        $singleCategory = null;
        $action = route('admin.categories.store');
        return view('admin.category-index', compact('categories', 'singleCategory', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $singleCategory = Category::findOrFail($id);
        $categories = Category::with('parent')->orderBy('parent_id')->paginate(50);
        $action = route('admin.categories.update', $id);
        return view('admin.category-index', compact('categories', 'singleCategory', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        return redirect()->route('admin.categories.index');
    }


    public function categoryWrite()
    {
        // ini_set('memory_limit', '10240M');
        $categories = Category::get(['name', 'slug']);
        $category_file = fopen(base_path('resources/lang/en/category-seo.php'), 'w');

        $array = [];
        $txt = "<?php return ";
        // fwrite($category_file, $txt);
        foreach ($categories as $category) {
            // $value = "'$category->name' => '$category->name',";
            // fwrite($category_file, $value);
            $array["seo-title:" . $category->name] = $category->seo_title;
            $array["seo-description:" . $category->name] = $category->seo_description;
        }
        fwrite($category_file, $txt . var_export($array, true) . ";");
        // fwrite($category_file, "];");
        fclose($category_file);
        return 'success';
    }
}
