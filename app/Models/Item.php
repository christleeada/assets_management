<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;




class Item extends Model
{
    use HasFactory;
    protected $fillable = [
                           'inventory_type',
                           'item_name',
                           'image',
                           'post_status_id',
                           'unit_type',
                           'item_category',
                           'price',
                           'brand',
                           'sku_no',
                           'upc_no',
                           'remarks',
                           'description',
                           'quantity',
                           'date_purchased',
                           
                           
                           
                           
                          ];
                          

    public function status(){
        return $this->belongsTo(Status::class,'post_status_id', 'id');
    }
    public function itemCategory(){
        return $this->belongsTo(ItemCategory::class,'item_category', 'id');
    }
    public function location(){
        return $this->belongsTo(Location::class,'location', 'id');
    }
    public function unitType(){
        return $this->belongsTo(UnitType::class,'unit_type', 'id');
    }
    public function inventoryType(){
        return $this->belongsTo(InventoryType::class,'inventory_type', 'id');
    }
    

    
    
}
