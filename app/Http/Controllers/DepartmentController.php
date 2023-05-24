<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Department::with('status')->get();
        
        return view('layouts.departments.index',compact('data'));
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
        'department' => 'required',
        'post_status_id' => 'required',
    ]);

    // $validatedData['post_status_id'] = $request->input('post_status_id', 1);

    Department::create($validatedData);

    return redirect()->route('department.index')
        ->with('success', 'Department has been created successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        if(!$request->filled('post_status_id')){
            $request->merge(['post_status_id' => 1]);
    
        }
       
        $validatedData = $request->validate([
            'department' => 'required',
            'post_status_id' => 'required',
        ]);
    
       $department->update($validatedData);
    
        return redirect()->route('department.index')
            ->with('info', 'Department has been updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
    
        return redirect()->route('department.index')
            ->with('danger', 'Department has been deleted successfully');
    }
}
