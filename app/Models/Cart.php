<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    //mass assigning
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];
    //belongs to user
    public function user(): BelongsTo{
     return $this->belongsTo(User::class);
    }
      //belongs to products
    public function product(): BelongsTo{
     return $this->belongsTo(Product::class);
    }
        public function orders(): BelongsTo{
     return $this->belongsTo(Order::class);
    }

}
