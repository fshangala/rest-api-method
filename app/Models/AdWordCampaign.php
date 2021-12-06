<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AdWordCampaign extends Model
{
    protected $fillable = [
        'campaign_name',
        'campaign_address_line_1',
        'campaign_address_line_2',
        'campaign_address_post_number',
        'campaign_address_phone_number'
    ];
}
