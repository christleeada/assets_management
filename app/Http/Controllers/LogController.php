<?php

namespace App\Http\Controllers;

use App\Models\Log; // Update the Log model namespace
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as LaravelLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogHelper;
class LogController extends Controller
{
    public function index()
    {
        $logs = Log::with('user')->get();
        return view('layouts.logs.index', compact('logs'));
    }

    public function performAction(Request $request)
    {
        // Perform the action

        LaravelLog::info('User performed an action', [
            'id' => Auth::id(),
            'event' => 'Performed an action',
        ]);

        // Return the response
    }

    public function showLogs()
    {
        $logs = LaravelLog::getLogs(); // Replace with your own logic to fetch the logs

        return view('layouts.logs.index', compact('logs'));
    }
    protected function login(Request $request)
    {
        // Authenticate the user...

        // Save the user login activity log
        $username = Auth::user()->first_name; 
        LogHelper::createLog('User: ' . $username . ' logged in');
        

        return view('dashboard');
    }
    protected function logout(Request $request)
    {
        DB::table('logs')->insert([
            'event' => 'logout',
            'created_at' => now(),
        ]);

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }
    protected function authenticated(Request $request, $user)
    {
        DB::table('logs')->insert([
            'event' => 'login',
            'created_at' => now(),
        ]);

        return redirect()->intended($this->redirectPath());
    }
}
