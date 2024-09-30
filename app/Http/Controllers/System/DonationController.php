<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\ResourceController;
use App\Services\DonationService;
use App\Services\PageService;
use App\Services\UserService;

class DonationController extends ResourceController
{
    public function __construct(private readonly DonationService $thisService)
    {
        parent::__construct($thisService);
    }


    public function moduleName()
    {
        return 'donations';
    }

    public function viewFolder()
    {
        return 'backend.system.donation';
    }

}
