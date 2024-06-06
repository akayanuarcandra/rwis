<?php

namespace App\Http\Controllers\information;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::all();
        return Auth::check() ? view('information.facility.index',compact('facilities')) : redirect('login');
    }


    public function archived()
    {
        $archivedFacilities = Facility::where('is_archived', true)->get();
        return view('information.facility.archived', compact('archivedFacilities'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //upload image
        return view('information.facility.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //upload image
        return $request->file('image')->store('post-image');

        $request->validate([
            'facility_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',

        ]);

        Facility::create([
            'facility_id' => $request->facility_id,
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'is_archived' => false

        ]);

        return redirect('information/facility')->with('success', 'Facility has been added');
    }

    /**
     * Display the specified resource.
     */
    /*public function show($id)
    {
    $facility = Facility::findOrFail($id);
    return view('information.facility.show', compact('facility'));
    }*/
public function show(string $id)
{
    $facility = Facility::find($id);
    return view('information.facility.show', compact('facility'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $facility = Facility::findOrFail($id);
        return view('information.facility.edit', compact('facility'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        $facility = Facility::findOrFail($id);
        $facility->update([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        return redirect('information/facility')->with('success', 'Facility has been updated');
    }
/**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();

        return redirect('information/facility')->with('success', 'Facility has been deleted');
    }
}
