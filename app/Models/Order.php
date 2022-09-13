<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User','customer_id');
    }

    public function city(){
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    
    public function detail(){
        return $this->hasOne('App\Models\Address','order_id');
    }
}
