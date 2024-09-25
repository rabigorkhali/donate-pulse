<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\ResourceController;
use App\Services\ContactUsService;

class ContactUsController extends ResourceController
{
    public function __construct(private readonly ContactUsService $thisService)
    {
        parent::__construct($thisService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\ContactUsRequest';
    }

    public function moduleName()
    {
        return 'contact-us';
    }

    public function viewFolder()
    {
        return 'backend.system.contact-us';
    }

}
