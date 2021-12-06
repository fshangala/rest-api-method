<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'partner',
        'type',
        'submitted_by',
        'company_id',
        'company_name',
        'contact_first_name',
        'contact_last_name',
        'contact_title',
        'contact_phone',
        'contact_mobile',
        'contact_email',
        'exposure_id',
        'udac',
        'related_order',
    ];
}
