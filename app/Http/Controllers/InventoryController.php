<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryType;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Inventory::with('status')->get();
        // dd($data);
        return view('layouts.inventories.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $stocks = Item::all();
        $inventory_types = InventoryType::all();
        return view('layouts.inventories.create')
        ->with('inventory_types',$inventory_types)
        ->with('locations',$locations)
        ->with('stocks',$stocks);
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
            'date' => 'required|date',
            'location' => 'required',
            'remarks' => 'required',
            
            

        ]);
        Inventory::create($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
    public function getItemDetails($id)
{
    $item = Item::find($id);
    return response()->json($item);
}


}
