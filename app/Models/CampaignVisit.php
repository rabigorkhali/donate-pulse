<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CampaignVisit extends Model
{
    protected $fillable = [
        'ip',
        'campaign_id',
        'longitude',
        'latitude',
        'created_at',
    ];
}
