<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;

class UnitType extends Model
{
    use HasFactory;
    protected $fillable = ['unit_type','post_status_id'];
    
    public function status(){
        return $this->belongsTo(Status::class,'post_status_id', 'id');
    }

    public function item(){
        return $this->hasOne(Item::class,'unit_type', 'id');
    } 
}

