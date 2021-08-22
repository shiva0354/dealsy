<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Location;

class AdminLocationController extends Controller
{
    /**
     * Displaying list of locations
     * @param Location $locations,$singleLocation
     * @param string $action
     */
    public function index()
    {
        $locations = Location::with('state')->orderBy('parent_id')->paginate(50);
        $singleLocation = null;
        $action = route('admin.locations.store');
        return view('admin.location-index', compact('locations', 'singleLocation', 'action'));
    }

    /**
     * Displaying edit form to edit location
     *
     * @param int $id
     *
     */
    public function edit($id)
    {
        $singleLocation = Location::findOrFail($id);
        $locations = Location::with('state')->orderBy('parent_id')->paginate(50);
        $action = route('admin.locations.update', $id);
        return view('admin.location-index', compact('locations', 'singleLocation', 'action'));
    }

    /**
     * Storing a newly created location
     *
     * @param LocationRequest $request
     */
    public function store(LocationRequest $request)
    {
        Location::create($request->validated());
        return redirect()->route('admin.locations.index')->with('success', 'Location added successfully');
    }

    /**
     * Updating a location
     *
     * @param LocationRequest $request
     * @param int $id
     */
    public function update(LocationRequest $request, $id)
    {
        $location = Location::findOrFail($id);
        $location->update($request->validated());
        return redirect()->route('admin.locations.index')->with('success', 'Location updated successfully');
    }
}
