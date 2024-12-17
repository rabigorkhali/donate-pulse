<?php

namespace App\Models;

use App\Models\CampaignCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CampaignView extends Model
{
    use SoftDeletes;
    protected $table = 'campaigns_summary_view';

    protected $dates = ['end_date','start_date'];

    public function category()
    {
        return $this->belongsTo(CampaignCategory::class,'campaign_category_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
