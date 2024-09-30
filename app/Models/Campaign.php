<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'goal_amount',
        'country',
        'address',
        'campaign_status',
        'campaign_category_id',
        'is_featured',
        'cover_image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(CampaignCategory::class, 'campaign_category_id');
    }
}
