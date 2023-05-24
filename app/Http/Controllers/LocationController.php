<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Location;
use Database\Seeders\LocationSeeder;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $departments = Department::all();
        $data = Location::with('status','department')->get();
        // dd($data);
        return view('layouts.locations.index',compact('data', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all);
        if(!$request->filled('post_status_id')){
            $request->merge(['post_status_id' => 1]);
    
        }
       
        $validatedData = $request->validate([
            'dept_id' => 'required',
            'location_name' => 'required',
            'location_address' => 'required',
            'post_status_id' => 'required',
        ]);
    
        // $validatedData['post_status_id'] = $request->input('post_status_id', 1);
    
        Location::create($validatedData);
    
        return redirect()->route('location.index')
            ->with('success', 'Location has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(location $location)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        if(!$request->filled('post_status_id')){
            $request->merge(['post_status_id' => 1]);
    
        }
       
        $validatedData = $request->validate([
            'dept_id' => 'nullable',
            'location_name' => 'required',
            'location_address' => 'required',
            'post_status_id' => 'required',
        ]);

        
    
       $location->update($validatedData);
    
        return redirect()->route('location.index')
            ->with('info', 'Location has been updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
    
        return redirect()->route('location.index')
            ->with('danger', 'Location has been deleted successfully');
    }
}
