<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'campaign_id',
        'user_id',
        'payment_gateway_id',
        'withdrawal_status',
        'withdrawal_transaction_id',
        'withdrawal_mobile_number',
        'withdrawal_amount',
        'withdrawal_service_charge',
        'is_email_sent',
        'successful_withdrawal_date',
        'withdrawal_request_date',
    ];

    protected $dates = ['successful_withdrawal_date', 'withdrawal_request_date', 'deleted_at'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function campaignView()
    {
        return $this->belongsTo(CampaignView::class,'campaign_id');
    }

    /**
     * Relationship with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with PaymentGateway.
     */
    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
