<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['category_id','name','stock','description','price','pictures'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function product_order()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function cart_item()
    {
        return $this->hasMany(CartItem::class);
    }
}
