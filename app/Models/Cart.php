<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    public $primaryKey = 'id';
    protected $dates = ["deleted_at"];

    protected $fillable = [
        'customer_id',
        'deleted_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id");
    }
}
