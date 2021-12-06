<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    protected $fillable = [
        'partner_id',
        'token'
    ];
}
