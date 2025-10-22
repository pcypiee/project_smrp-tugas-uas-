<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryStock extends Model
{
    use SoftDeletes;

    protected $table = 'inventory_stocks';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    // public function item()
    // {
    //     return $this->belongsTo(Item::class, 'item_id');
    // }

    // public function lokasi()
    // {
    //     return $this->belongsTo(Lokasi::class, 'lokasi_id');
    // }
}
