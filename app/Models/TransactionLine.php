<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionLine extends Model
{
    use HasFactory, SoftDeletes;

    public $primaryKey = 'id';
    protected $dates = ["deleted_at"];

    protected $fillable = [
        'product_id',
        "transaction_id",
        "quantity",
        'deleted_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, "transaction_id");
    }
}
