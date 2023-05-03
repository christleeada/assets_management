<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['department','post_status_id'];

    public function status(){
        return $this->belongsTo(Status::class,'post_status_id', 'id');
    }
    public function loc(){
        return $this->hasMany(Location::class,'department', 'id');
    } 
}
