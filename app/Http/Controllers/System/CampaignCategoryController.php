<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\ResourceController;
use App\Services\CampaignCategoryService;
use App\Services\PostCategoryService;

class CampaignCategoryController extends ResourceController
{
    public function __construct(private readonly CampaignCategoryService $thisService)
    {
        parent::__construct($thisService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\CampaignCategoryRequest';
    }

    public function moduleName()
    {
        return 'campaign-categories';
    }

    public function viewFolder()
    {
        return 'backend.system.campaign-category';
    }

}
