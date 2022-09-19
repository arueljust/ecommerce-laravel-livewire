<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
