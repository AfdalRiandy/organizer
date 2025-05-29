<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_vendor',
        'nama_jasa',
        'deskripsi_jasa',
        'harga_jasa',
        'is_active'
    ];

    /**
     * Get the user that owns the service.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the orders that have this service.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_jasa')
                    ->withPivot('status', 'catatan')
                    ->withTimestamps();
    }

    /**
     * Format the price as Indonesian Rupiah
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga_jasa, 0, ',', '.');
    }
}