<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected function casts(): array
    {
        return [
            'total' => 'float',
        ];
    }
    
    //mass assigning
    protected $fillable = [
        'user_id',
        'total',
        'status'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    //order belongs to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
