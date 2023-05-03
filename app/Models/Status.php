<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function status(){
        return $this->hasOne(Department::class,'post_status_id', 'id');
    }   
}
