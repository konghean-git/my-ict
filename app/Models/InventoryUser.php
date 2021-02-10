<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InventoryUser extends Pivot
{
    use HasFactory;
    public function references()
    {
        return $this->belongsTo(User::class,'reference_id');
    }
    public function preparers()
    {
        return $this->belongsTo(User::class, 'preparer_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function inventories()
    {
        return $this->belongsTo(Inventory::class,'inventory_id');
    }
    // public function inventories()
    // {
    //     return $this->belongsTo(User::class, 'inventory_id');
    // }
}
