<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paket_id',
        'event_date',
        'catatan',
        'status',
        'metode_pembayaran'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function jasas()
    {
        return $this->belongsToMany(Jasa::class, 'order_jasa')
                    ->withPivot('status', 'catatan')
                    ->withTimestamps();
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'menunggu' => 'warning',
            'disetujui' => 'primary',
            'lunas' => 'success',
            default => 'secondary',
        };
    }
}