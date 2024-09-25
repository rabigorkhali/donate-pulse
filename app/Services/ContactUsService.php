<?php

namespace App\Services;

use App\Models\ContactUs;
use App\Models\Page;
use App\Models\Role;

class ContactUsService extends Service
{
    public function __construct(ContactUs $model)
    {
        parent::__construct($model);
    }
}
