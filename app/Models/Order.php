<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    //mass assigning
    protected $fillable =[
     'user_id',
     'total',
     'status'
    ];
    //order belongs to user
    public function user():BelongsTo
    {return $this->belongsTo(User::class);}
}
