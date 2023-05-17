<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;
    
    protected $fillable = ['item_category','estimated_lifespan','message','post_status_id'];
    
    public function status(){
        return $this->belongsTo(Status::class,'post_status_id', 'id');
    }

    public function items(){
        return $this->hasMany(Item::class,'item_category', 'id');
    }
}