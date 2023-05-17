<?php

namespace App\Helpers;

use App\Models\Log;

class LogHelper
{
    public static function createLog($event)
    {
        $log = new Log();
        $log->event = $event;
        $log->user_id = auth()->id();
        $log->save();
    }
}
