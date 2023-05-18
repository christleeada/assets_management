<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function loginuser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $username = Auth::user()->first_name;
            LogHelper::createLog($username . ' logged in');

            return redirect()->route('dashboard');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    

    protected function logout()
{
    $username = Auth::user()->first_name;
    LogHelper::createLog($username . ' logged out');


    return redirect('/');
}


    // protected function authenticated(Request $request, $user)
    // {
    //     DB::table('logs')->insert([
    //         'event' => 'login',
    //         'created_at' => now(),
    //     ]);

    //     return redirect()->intended($this->redirectPath());
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
