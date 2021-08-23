<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoDefaultRequest;
use App\Http\Requests\SeoToolRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\SeoTool;
use Exception;
use Illuminate\Support\Facades\Gate;

class AdminSeoController extends Controller
{
    /** Creating urls for all category and locations route */
    public static function createUrl()
    {
        set_time_limit(-1);
        $categories = Category::get(['id', 'slug']);
        $locations = Location::get(['id', 'slug', 'parent_id']);

        foreach ($categories as $category) {
            $category_url = "/" . $category->slug . "_c" . $category->id;
            SeoTool::firstOrCreate(['url' => $category_url]);

            foreach ($locations as $location) {
                $location_url = "/" . $location->slug . "_g" . $location->id;
                SeoTool::firstOrCreate(['url' => $location_url]);
                SeoTool::firstOrCreate(['url' => $location_url . $category_url]);
                if ($location->parent_id) {
                    $localities = $location->posts()->distinct('locality')->pluck('locality');
                    foreach ($localities as $locality) {
                        $locality_url = "/" . strtolower(str_replace(" ", "_", $locality));
                        SeoTool::firstOrCreate(['url' => $location_url . $locality_url]);
                        SeoTool::firstOrCreate(['url' => $location_url . $locality_url . $category_url]);
                    }
                }
            }
        }
    }


    /**
     * Lists of all
     */
    public function index()
    {
        $response = Gate::inspect('perform_seo');
        if (!$response->allowed())  return back()->with('error', $response->message());

        $seoTools = SeoTool::paginate();
        return view('admin.seotool-index', compact('seoTools'));
    }

    /**
     * Displaying view file for creating seo details
     */
    public function create()
    {
        $response = Gate::inspect('perform_seo');
        if (!$response->allowed())  return back()->with('error', $response->message());

        $seoTool = null;
        $action = route('admin.seo-tools.store');
        $referrer = old('_referrer', url()->previous());
        return view('admin.seotool-edit', compact('seoTool', 'action', 'referrer'));
    }

    public function store(SeoToolRequest $request)
    {
        $response = Gate::inspect('perform_seo');
        if (!$response->allowed())  return back()->with('error', $response->message());

        $fields = $request->validated();
        try {
            SeoTool::create($fields);
        } catch (Exception $e) {
            return back()->with('warning', 'Could not create seoTool. ' . $e->getMessage());
        }

        $referrer = $request->get('_referrer');
        $redirectTo = $referrer ?: route('admin.seo-tools.index');

        return redirect($redirectTo)->with('success', 'SeoTool created successfully');
    }

    /**
     * Displaying details of seo for particulare url
     */
    public function show($id)
    {
        $response = Gate::inspect('perform_seo');
        if (!$response->allowed())  return back()->with('error', $response->message());

        $seoTool = SeoTool::findOrFail($id);
        return view('admin.seotool-show', compact('seoTool'));
    }

    /**
     * Displaying edit file for editing seo details
     */
    public function edit($id)
    {
        $response = Gate::inspect('perform_seo');
        if (!$response->allowed())  return back()->with('error', $response->message());

        $seoTool = SeoTool::findOrFail($id);
        $action = route('admin.seo-tools.update', $id);
        $referrer = old('_referrer', url()->previous());
        return view('admin.seotool-edit', compact('seoTool', 'action', 'referrer'));
    }

    /**
     * Updating seo details for particular url
     */
    public function update(SeoToolRequest $request, $id)
    {
        $response = Gate::inspect('perform_seo');
        if (!$response->allowed())  return back()->with('error', $response->message());

        $seoTool = SeoTool::findOrFail($id);
        $fields = $request->validated();
        try {
            $seoTool->update($fields);
        } catch (Exception $e) {
            return back()->with('warning', 'Could not update seoTool. ' . $e->getMessage());
        }

        $referrer = $request->get('_referrer');
        $redirectTo = $referrer ?: route('admin.seo-tools.index');

        return redirect($redirectTo)->with('success', 'SeoTool updated successfully');
    }

    /**
     * Deleting a seo detail for particular url
     */
    public function destroy($id)
    {
        $response = Gate::inspect('perform_seo');
        if (!$response->allowed())  return back()->with('error', $response->message());

        return back()->with('error', 'Deleting is currently not allowed.');
        $seoTool = SeoTool::findOrFail($id);
        try {
            $seoTool->delete();
        } catch (Exception $e) {
            return back()->with('warning', 'Could not delete seoTool. ' . $e->getMessage());
        }

        return back()->with('success', 'SeoTool deleted successfully');
    }

    /**
     * Showing view file for default seo
     */
    public function seoDefaultView()
    {
        $response = Gate::inspect('perform_seo');
        if (!$response->allowed())  return back()->with('error', $response->message());

        $action = route('admin.seo-tools.default.update');
        $referrer = old('_referrer', url()->previous());
        return view('admin.seotool-default', compact('action', 'referrer'));
    }
    /**
     * Changing Seo Default Setting in seo config
     */
    public function seoDefault(SeoDefaultRequest $request)
    {
        $response = Gate::inspect('perform_seo');
        if (!$response->allowed())  return back()->with('error', $response->message());

        $fields = $request->validated();
        $txt = "<?php return ";
        $file = fopen(config_path('seo.php'), 'w');
        fwrite($file, $txt . var_export($fields, true) . ";");
        fclose($file);
        return back()->with('success', 'Changes saved successfully');
    }
}
