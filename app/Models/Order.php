<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'partner',
        'type',
        'submitted_by',
        'campany_id',
        'company_name'
    ];
}
