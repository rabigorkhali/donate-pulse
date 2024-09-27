<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_gateway',
        'mobile_number',
        'bank_name',
        'bank_account_name',
        'bank_swift_code',
        'bank_address',
        'bank_account_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
