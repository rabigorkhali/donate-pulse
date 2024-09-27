<?php

namespace App\Services;

use App\Models\Page;
use App\Models\PaymentGateway;
use App\Models\Role;
use App\Models\User;

class PaymentGatewayService extends Service
{
    public function __construct(PaymentGateway $model)
    {
        parent::__construct($model);
    }
    public function createPageData($request)
    {
        return [
            'users' => User::orderby('name')->get(),
        ];
    }
    public function editPageData($request, $id)
    {
        return [
            'users' => User::orderby('name')->get(),
            'thisData' => $this->itemByIdentifier($id),
        ];
    }
}
