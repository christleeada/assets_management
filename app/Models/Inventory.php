<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventory_type',
        'location',
        'post_status_id',
        'sku_no',
        'upc_no',
        'remarks',
       
        
        
       ];

public function status(){
return $this->belongsTo(Status::class,'post_status_id', 'id');
}
public function itemCategory(){
return $this->belongsTo(ItemCategory::class,'item_category', 'id');
}
public function loc(){
return $this->belongsTo(Location::class,'location', 'id');
}

public function inventoryType(){
return $this->belongsTo(InventoryType::class,'inventory_type', 'id');
}
}
