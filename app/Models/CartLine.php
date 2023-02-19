<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartLine extends Model
{
    use HasFactory, SoftDeletes;

    public $primaryKey = 'id';
    protected $dates = ["deleted_at"];

    protected $fillable = [
        'product_id',
        "cart_id",
        "quantity",
        'deleted_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, "cart_id");
    }
}
