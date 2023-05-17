<?php

namespace App\Http\Controllers;

use App\Models\Log; // Update the Log model namespace
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as LaravelLog;

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

        return view('logs.show', compact('logs'));
    }
}
