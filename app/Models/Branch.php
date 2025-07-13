<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable=[
        'name',
        'location',
        'latitude',
        'longitude'
    ];
    public function order(){
        return $this->hasMany(Order::class);
    }
}
