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

    public function store($request)
    {
        $data = $request->except('_token');
        $userId = $data['user_id'] ?? authUser()->id;
        $countPaymentGateway = PaymentGateway::where('user_id', $userId)->count();
        if ($countPaymentGateway > 2) {
            $message['error'] = 'You cannot add more than 3 active payment gateways. Please delete anyone before adding new one.';
            return $message;
        }
        return $this->model->create($data);
    }

    public function editPageData($request, $id)
    {
        return [
            'users' => User::orderby('name')->get(),
            'thisData' => $this->itemByIdentifier($id),
        ];
    }
}
