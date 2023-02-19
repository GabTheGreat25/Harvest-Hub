<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id");
    }
}
