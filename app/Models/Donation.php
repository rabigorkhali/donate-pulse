<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'giver_user_id',
        'receiver_user_id',
        'campaign_id',
        'transaction_id',
        'is_anonymous',
        'fullname',
        'country',
        'email',
        'payment_status',
        'payment_gateway',
        'amount',
        'service_charge_percentage',
        'mobile_number',
        'is_verified',
        'payment_receipt',
        'address',
        'description',
        'payment_gateway_all_response',
        'donor_display_image',
    ];

    public function giver()
    {
        return $this->belongsTo(User::class, 'giver_user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
