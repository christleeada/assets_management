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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.item_categories.create');
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
            'post_status_id' => 'required',
        ]);
    
        // $validatedData['post_status_id'] = $request->input('post_status_id', 1);
    
        ItemCategory::create($validatedData);
    
        return redirect()->route('item_category.index')
            ->with('success', 'Item Category has been created successfully');
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
        return view('layouts.item_categories.create',compact('itemCategory'));
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
            'post_status_id' => 'required',
        ]);
    
       $itemCategory->update($validatedData);
    
        return redirect()->route('item_category.index')
            ->with('info', 'Item category has been updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemCategory $itemCategory)
    {
        $itemCategory->delete();
    
        return redirect()->route('item_category.index')
            ->with('danger', 'Item category has been deleted successfully');
    }
}
