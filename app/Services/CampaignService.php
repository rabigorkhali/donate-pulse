<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\CampaignCategory;
use App\Models\PostCategory;
use App\Models\Role;
use App\Models\User;

class CampaignService extends Service
{
    public function __construct(Campaign $model)
    {
        parent::__construct($model);
    }

    public function createPageData($request)
    {
        return [
            'users' => User::orderby('name', 'asc')->get(),
            'campaignCategories' => CampaignCategory::orderby('title', 'asc')->get(),
        ];
    }

    public function editPageData($request, $id)
    {
        return [
            'users' => User::orderby('name', 'asc')->get(),
            'campaignCategories' => CampaignCategory::orderby('title', 'asc')->get(),
            'thisData' => $this->itemByIdentifier($id),
        ];
    }
}
