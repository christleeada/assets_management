<?php

namespace App\Helpers;

use App\Models\Logs;

class LogHelper
{
    public static function createLog($event)
    {
        $log = new Logs();
        $log->event = $event;
        $log->user_id = auth()->id();
        $log->save();
    }
}
