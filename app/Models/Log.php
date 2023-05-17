<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createLog($event)
    {
        $log = new Log();
        $log->event = $event;
        $log->user_id = auth()->id();
        $log->save();
    }
}
