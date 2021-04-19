<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Library\AdminAuthGuard;
use App\Models\Location;

class AdminLocationController extends Controller
{
    use AdminAuthGuard;

    public function index()
    {
        $locations = Location::with('parent')->orderBy('parent_id')->paginate(50);
        $singleLocation = null;
        $action = route('admin.locations.store');
        return view('admin.location-index', compact('locations', 'singleLocation', 'action'));
    }

    public function edit($id)
    {
        $singleLocation = Location::findOrFail($id);
        $locations = Location::with('parent')->orderBy('parent_id')->paginate(50);
        $action = route('admin.locations.update', $id);
        return view('admin.location-index', compact('locations', 'singleLocation', 'action'));
    }

    public function store(LocationRequest $request)
    {
        dd($request->input());
        Location::create($request->validated());
        return redirect()->route('admin.locations.index')->with('success', 'Location added successfully');
    }

    public function update(LocationRequest $request, $id)
    {
        $location = Location::findOrFail($id);
        $location->update($request->validated());
        return redirect()->route('admin.locations.index')->with('success', 'Location updated successfully');
    }
}
