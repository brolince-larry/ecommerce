<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable =['product_id', 'order_id'];
  public function product()
{
    return $this->belongsTo(Product::class);
}

}
