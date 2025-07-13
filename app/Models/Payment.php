<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //mass assigning
    protected $fillable =[
        'user_id',
        'order_id',
        'amount',
        'status',
        'method',
        'mpesa_number',
        'bank_account',
        'paypal_email',
        'latitude',
        'longitude'
    ];
    //payment belong to an order
    public function order(){
        return $this->belongsTo(Order::class);
       
    }
     //payment belongs to a user
        public function user(){
         return $this->belongsTo(User::class);   
        }
}
