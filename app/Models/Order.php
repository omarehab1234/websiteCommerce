<?php

namespace App\Models;
use App\Models\OrderItem;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =[
        'user_id',    
        'total_price',
        'status',
        'payment_method',
        'payment_status',
        'phone',
        'address',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
