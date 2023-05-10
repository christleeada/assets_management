<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('layouts.users.index')->with('data', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    
        // $validatedData['post_status_id'] = $request->input('post_status_id', 1);
        $validatedData['password'] = Hash::make($validatedData['password']);

    
        User::create($validatedData);
    
        return redirect()->route('user.index')
            ->with('success', 'User has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('layouts.users.create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'middle_name' => 'nullable',
            'address' => 'nullable',
            'contact_no' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
            
        ]);
        $user->update($validatedData);
        

    
       
        return redirect()->route('user.index')
            ->with('info', 'User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('danger', 'User has been deleted successfully');
    }
}
