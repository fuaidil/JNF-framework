<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = ['id','user_id','total_product'];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function cart_item()
    {
        return $this->hasMany(CartItem::class);
    }
}
