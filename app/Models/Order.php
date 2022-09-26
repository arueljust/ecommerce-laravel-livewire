<?php

namespace App\Models;

use App\Models\Orderitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table='order';

    protected $fillable=[
        'user_id',
        'tracking_no',
        'fullname',
        'nik',
        'email',
        'Phone',
        'pincode',
        'address',
        'status',
        'payment_mode',
        'payment_id',

    ];

    Public function orderItem():HasMany
    {
        return $this->hasMany(Orderitem::class,'order_id','id');
    }
}
