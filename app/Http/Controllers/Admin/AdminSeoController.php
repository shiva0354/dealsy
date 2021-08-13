<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoToolRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\SeoTool;
use Exception;

class AdminSeoController extends Controller
{
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


    public function index()
    {
        $seoTools = SeoTool::paginate();
        return view('admin.seotool-index', compact('seoTools'));
    }

    public function create()
    {
        $seoTool = null;
        $action = route('admin.seo-tools.store');
        $referrer = old('_referrer', url()->previous());
        return view('seotool-edit', compact('seoTool', 'action', 'referrer'));
    }

    public function store(SeoToolRequest $request)
    {
        $fields = $request->validated();
        try {
            SeoTool::create($fields);
        } catch (Exception $e) {
            return redirect()->back()->with('warning', 'Could not create seoTool. ' . $e->getMessage());
        }

        $referrer = $request->get('_referrer');
        $redirectTo = $referrer ?: route('admin.seo-tools.index');

        return redirect($redirectTo)->with('success', 'SeoTool created successfully');
    }

    public function show($id)
    {
        $seoTool = SeoTool::findOrFail($id);
        return view('admin.seotool-show', compact('seoTool'));
    }

    public function edit($id)
    {
        $seoTool = SeoTool::findOrFail($id);
        $action = route('admin.seo-tools.update', $id);
        $referrer = old('_referrer', url()->previous());
        return view('admin.seotool-edit', compact('seoTool', 'action', 'referrer'));
    }

    public function update(SeoToolRequest $request, $id)
    {
        $seoTool = SeoTool::findOrFail($id);
        $fields = $request->validated();
        try {
            $seoTool->update($fields);
        } catch (Exception $e) {
            return redirect()->back()->with('warning', 'Could not update seoTool. ' . $e->getMessage());
        }

        $referrer = $request->get('_referrer');
        $redirectTo = $referrer ?: route('admin.seo-tools.index');

        return redirect($redirectTo)->with('success', 'SeoTool updated successfully');
    }

    public function destroy($id)
    {
        $seoTool = SeoTool::findOrFail($id);
        try {
            $seoTool->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('warning', 'Could not delete seoTool. ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'SeoTool deleted successfully');
    }
}
