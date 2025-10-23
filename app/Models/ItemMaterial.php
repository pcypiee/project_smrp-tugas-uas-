<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemMaterial extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    protected $fillable = [
        'nama_item',
        'unit_satuan',
        'rop',
        'created_by',
        'updated_by'
    ];

    protected $dates = ['deleted_at'];
}