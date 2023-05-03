<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    use HasFactory;

    protected $fillable = ['inventory_type','post_status_id'];
    
    public function status(){
        return $this->belongsTo(Status::class,'post_status_id', 'id');
        
    }
    public function item(){
        return $this->hasMany(Item::class,'inventory_type', 'id');
    } 
}