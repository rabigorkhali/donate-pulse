<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\Page;
use App\Models\PaymentGateway;
use App\Models\Role;
use App\Models\User;
use App\Models\Withdrawal;

class WithdrawalService extends Service
{
    public function __construct(Withdrawal $model)
    {
        parent::__construct($model);
    }

    public function indexPageData($request)
    {
        return [
            'users' => User::orderby('name')->get(),
            'thisDatas' => $this->getAllData($request),
        ];
    }

    public function createPageData($request)
    {
        return [
            'users' => User::orderby('name')->get(),
            'paymentGateways' => PaymentGateway::orderby('payment_gateway')->get(),
            'campaigns' => Campaign::orderby('title')->get()
        ];
    }
}
