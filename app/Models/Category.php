<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //mass assigning
    protected $fillable =[
        'name',
        'description'
    ];
    public function  Products(){
        return $this->hasMany(Product::class);
    }
}
