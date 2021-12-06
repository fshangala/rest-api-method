<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'partner_id',
        'product_id',
        'detail_id',
        'status'
    ];
}
