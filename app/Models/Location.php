<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['dept_id', 'location_name','location_address','post_status_id'];
    
    public function status(){
        return $this->belongsTo(Status::class,'post_status_id', 'id');
    }
    public function departmenT(){
        return $this->belongsTo(Department::class,'dept_id', 'id');
    }
    public function invenTory(){
        return $this->belongsTo(Inventory::class,'inventory', 'id');
    }
}
