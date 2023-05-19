<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\LogHelper;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'profilepic' => 'nullable',
        'first_name' => 'required',
        'last_name' => 'required',
        'middle_name' => 'required',
        'address' => 'required',
        'contact_no' => 'required',
        'email' => 'required',
        'password' => 'required',
        'role' => 'required',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    if ($request->hasfile('profilepic')) {
        $filename = time() . '.' . $request->file('profilepic')->getClientOriginalExtension();
        $request->file('profilepic')->move('uploads/profilepic/', $filename);
        $validatedData['profilepic'] = $filename;
    }

    User::create($validatedData);

    $username = str_replace(' ', ' ', $request->first_name);

    LogHelper::createLog(' added a user named '. $username);

    return redirect()->route('user.index')->with('success', 'User has been created successfully');
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
        $username = str_replace(' ', ' ', $user->first_name);
        LogHelper::createLog('edited user named '. $username);
        return view('layouts.users.create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'profilepic' => 'nullable',
        'first_name' => 'nullable',
        'last_name' => 'nullable',
        'middle_name' => 'nullable',
        'address' => 'nullable',
        'contact_no' => 'nullable',
        'email' => 'nullable',
        'password' => 'nullable',
        'role' => 'required',
    ]);

    // Check if the password is provided and not empty
    if ($request->filled('password')) {
        // Encrypt the password using bcrypt
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        // Remove the password from the validated data to avoid updating it
        unset($validatedData['password']);
    }
    if ($request->hasfile('profilepic')) {
        $filename = time() . '.' . $request->file('profilepic')->getClientOriginalExtension();
        $request->file('profilepic')->move('uploads/profilepic/', $filename);
        $validatedData['profilepic'] = $filename;
    }

    $user->update($validatedData);

    $username = str_replace(' ', ' ', $user->first_name);
    LogHelper::createLog('Updated user named ' . $username);

    return redirect()->route('user.index')
        ->with('info', 'User has been updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $user = User::find($id);
    
    if ($user->trashed()) {
        return redirect()->route('user.index')
            ->with('warning', 'User is already deleted.');
    }
    
    $username = str_replace(' ', ' ', $user->first_name);
    LogHelper::createLog('User deleted '. $username . ' from users');

    $user->delete();

    return redirect()->route('user.index')
        ->with('danger', 'User has been deleted successfully.');
}

    public function deleteUser(User $user, $id)
{
    
           
}
public function deletedUsers()
{
    $data = User::onlyTrashed()->get();

    return view('layouts.users.deleted_users', compact('data'));
}
public function restore($id)
{
    $user = User::withTrashed()->find($id);

    if ($user->trashed()) {
        $user->restore();
        $username = str_replace(' ', ' ', $user->first_name);
        LogHelper::createLog('User restored '. $username . ' in users');
        return redirect()->route('user.deletedUsers')
            ->with('success', 'user has been restored successfully.');
    }

    return redirect()->route('user.deletedUsers')
        ->with('warning', 'User is not deleted.');
}

    
}
