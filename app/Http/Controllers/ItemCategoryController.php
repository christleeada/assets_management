<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ItemCategory::with('status')->get();
     
        // dd($data);
        return view('layouts.item_categories.index',compact('data'));
        $categories = ItemCategory::pluck('item_category', 'id');

    return view('layouts.items.index', compact('categories'));
        
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
            'item_category' => 'required',
            'estimated_lifespan' => 'required',
            'message' => 'required',
            'post_status_id' => 'required',
        ]);
    
        // $validatedData['post_status_id'] = $request->input('post_status_id', 1);
    
        ItemCategory::create($validatedData);
    
        return redirect()->route('item_category.index')
            ->with('success', 'Asset Category has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemCategory $itemCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemCategory $itemCategory)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemCategory $itemCategory)
    {
        if(!$request->filled('post_status_id')){
            $request->merge(['post_status_id' => 1]);
    
        }
       
        $validatedData = $request->validate([
            'item_category' => 'required',
            'estimated_lifespan' => 'nullable',
            'message' => 'nullable',
            'post_status_id' => 'required',
        ]);
    
       $itemCategory->update($validatedData);
    
        return redirect()->route('item_category.index')
            ->with('info', 'Asset category has been updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemCategory $itemCategory)
    {
        $itemCategory->delete();
    
        return redirect()->route('item_category.index')
            ->with('danger', 'Asset category has been deleted successfully');
    }
}
