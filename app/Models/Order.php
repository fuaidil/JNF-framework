<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = ['order_address','order_date','total_price'];

    public function user_order()
    {
        return $this->hasMany(UserOrder::class);
    }

    public function product_order()
    {
        return $this->hasMany(ProductOrder::class);
    }
}
