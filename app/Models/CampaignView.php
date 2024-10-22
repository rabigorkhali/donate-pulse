<?php

namespace App\Models;

use App\Models\CampaignCategory;
use Illuminate\Database\Eloquent\Model;


class CampaignView extends Model
{
    protected $table = 'campaigns_summary_view';

    public function category()
    {
        return $this->belongsTo(CampaignCategory::class,'campaign_category_id');
    }
}
