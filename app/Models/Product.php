<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ["deleted_at"];

    public $primaryKey = 'id';

    protected $fillable = [
        'farmer_id',
        'name',
        "description",
        "price",
        'deleted_at',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, "farmer_id");
    }
}
