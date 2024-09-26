<?php

namespace App\Services;

use App\Models\CampaignCategory;
use App\Models\PostCategory;

class CampaignCategoryService extends Service
{
    public function __construct(CampaignCategory $model)
    {
        parent::__construct($model);
    }
}
