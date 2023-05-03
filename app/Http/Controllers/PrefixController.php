<?php

namespace App\Http\Controllers;

use App\Models\Prefix;
use Illuminate\Http\Request;

class PrefixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = prefix::with('status')->get();
        // dd($data);
        return view('layouts.prefixes.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.prefixes.create');
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
            'prefix' => 'required',
            'post_status_id' => 'required',
        ]);
    
        // $validatedData['post_status_id'] = $request->input('post_status_id', 1);
    
        prefix::create($validatedData);
    
        return redirect()->route('prefix.index')
            ->with('success', 'Item Category has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(prefix $prefix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(prefix $prefix)
    {
        return view('layouts.prefixes.create',compact('prefix'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, prefix $prefix)
    {
        if(!$request->filled('post_status_id')){
            $request->merge(['post_status_id' => 1]);
    
        }
       
        $validatedData = $request->validate([
            'prefix' => 'required',
            'post_status_id' => 'required',
        ]);
    
       $prefix->update($validatedData);
    
        return redirect()->route('prefix.index')
            ->with('info', 'Item category has been updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(prefix $prefix)
    {
        $prefix->delete();
    
        return redirect()->route('prefix.index')
            ->with('danger', 'prefix has been deleted successfully');
    }
}
