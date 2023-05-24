<?php

namespace App\Http\Controllers;

use App\Models\InventoryType;
use Illuminate\Http\Request;

class InventoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = InventoryType::with('status')->get();
        // dd($data);
        return view('layouts.inventory_types.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
            'inventory_type' => 'required',
            'post_status_id' => 'required',
        ]);
    
        // $validatedData['post_status_id'] = $request->input('post_status_id', 1);
    
        InventoryType::create($validatedData);
    
        return redirect()->route('inventory_type.index')
            ->with('success', 'Inventory Type has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryType $inventoryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryType $inventoryType)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryType $inventoryType)
    {
        if(!$request->filled('post_status_id')){
            $request->merge(['post_status_id' => 1]);
    
        }
       
        $validatedData = $request->validate([
            'inventory_type' => 'required',
            'post_status_id' => 'required',
        ]);
    
       $inventoryType->update($validatedData);
    
        return redirect()->route('inventory_type.index')
            ->with('info', 'Inventory Type has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryType $inventoryType)
    {
        $inventoryType->delete();
    
        return redirect()->route('inventory_type.index')
            ->with('danger', 'Inventory Type has been deleted successfully');
    }
}
