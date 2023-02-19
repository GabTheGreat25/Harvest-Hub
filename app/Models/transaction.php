<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    public $primaryKey = 'id';
    protected $dates = ["deleted_at"];

    protected $fillable = [
        'customer',
        "approved",
        "confirmed",
        'deleted_at',
    ];
}
