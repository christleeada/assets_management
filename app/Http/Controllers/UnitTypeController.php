<?php

namespace App\Http\Controllers;

use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UnitType::with('status')->get();
        // dd($data);
        return view('layouts.unit_types.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.unit_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->filled('post_status_id')){
            $request->merge(['post_status_id' => 1]);
    
        }
       
        $validatedData = $request->validate([
            'unit_type' => 'required',
            'post_status_id' => 'required',
        ]);
    
        // $validatedData['post_status_id'] = $request->input('post_status_id', 1);
    
        UnitType::create($validatedData);
    
        return redirect()->route('unit_type.index')
            ->with('success', 'Unit Type has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitType $unit_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitType $unit_type)
    {
        return view('layouts.unit_types.create',compact('unit_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitType $unit_type)
    {
        if(!$request->filled('post_status_id')){
            $request->merge(['post_status_id' => 1]);
    
        }
       
        $validatedData = $request->validate([
            'unit_type' => 'required',
            'post_status_id' => 'required',
        ]);
    
       $unit_type->update($validatedData);
    
        return redirect()->route('unit_type.index')
            ->with('info', 'Unit Type has been updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitType $unit_type)
    {
        $unit_type->delete();
    
        return redirect()->route('unit_type.index')
            ->with('danger', 'Unit Type has been deleted successfully');
    }
}
