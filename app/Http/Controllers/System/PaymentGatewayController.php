<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\ResourceController;
use App\Services\PageService;
use App\Services\PaymentGatewayService;
use App\Services\UserService;

class PaymentGatewayController extends ResourceController
{
    public function __construct(private readonly PaymentGatewayService $thisService)
    {
        parent::__construct($thisService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\PaymentGatewayRequest';
    }

    public function moduleName()
    {
        return 'payment-gateways';
    }

    public function viewFolder()
    {
        return 'backend.system.payment-gateway';
    }

}
