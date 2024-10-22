<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\ResourceController;

use App\Services\WithdrawalService;

class WithdrawalController extends ResourceController
{
    public function __construct(private readonly WithdrawalService $thisService)
    {
        parent::__construct($thisService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\WithdrawalRequest';
    }

    public function moduleName()
    {
        return 'withdrawals';
    }

    public function viewFolder()
    {
        return 'backend.system.withdrawal';
    }

}
