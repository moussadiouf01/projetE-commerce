<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalAttribute($value)
    {
        return number_format($value, 2, ',', ' ') . ' €';
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'en attente' => 'badge-warning',
            'en cours' => 'badge-info',
            'expédié' => 'badge-primary',
            'livré' => 'badge-success',
            'annulé' => 'badge-danger',
            default => 'badge-secondary'
        };
    }
}
