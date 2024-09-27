<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\ResourceController;
use App\Services\CampaignService;
use App\Services\PostCategoryService;

class CampaignController extends ResourceController
{
    public function __construct(private readonly CampaignService $thisService)
    {
        parent::__construct($thisService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\CampaignRequest';
    }

    public function moduleName()
    {
        return 'campaigns';
    }

    public function viewFolder()
    {
        return 'backend.system.campaign';
    }

}
