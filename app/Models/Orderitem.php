<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orderitem extends Model
{
    use HasFactory;

    protected $table='order_item';

    protected $fillable=[
    'order_id',
    'product_id',
    'quantity',
    'weight',
    'price'
    ];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
