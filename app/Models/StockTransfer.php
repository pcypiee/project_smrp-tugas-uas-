<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id',
        'asal_lokasi',
        'tujuan_lokasi',
        'jumlah',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Relasi ke Item Material
     */
    public function item()
    {
        return $this->belongsTo(ItemMaterial::class, 'item_id');
    }

    /**
     * Scope untuk filter by status
     */
    public function scopeInTransit($query)
    {
        return $query->where('status', 'In-Transit');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'Completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'Cancelled');
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'In-Transit' => 'warning',
            'Completed' => 'success',
            'Cancelled' => 'danger',
            default => 'secondary'
        };
    }
}