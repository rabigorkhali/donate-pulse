<?php

namespace App\Services;

use App\Models\Partner;
use App\Models\Testimonial;

class PartnerService extends Service
{
    public function __construct(Partner $model)
    {
        parent::__construct($model);
    }
}
