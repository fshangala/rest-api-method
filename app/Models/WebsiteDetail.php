<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WebsiteDetail extends Model
{
    protected $fillable = [
        'template_id',
        'website_business_name',
        'website_address_line_1',
        'website_address_line_2',
        'website_city',
        'website_state',
        'website_post_code',
        'website_phone',
        'website_email',
        'website_mobile'
    ];
}
