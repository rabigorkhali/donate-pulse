<?php

namespace App\Http\Controllers\Public;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Events\FileDeleted;
use App\Http\Controllers\Voyager\ContentTypes\Checkbox;
use App\Http\Controllers\Voyager\ContentTypes\Coordinates;
use App\Http\Controllers\Voyager\ContentTypes\File;
use App\Http\Controllers\Voyager\ContentTypes\Image as ContentImage;
use App\Http\Controllers\Voyager\ContentTypes\MultipleCheckbox;
use App\Http\Controllers\Voyager\ContentTypes\MultipleImage;
use App\Http\Controllers\Voyager\ContentTypes\Password;
use App\Http\Controllers\Voyager\ContentTypes\Relationship;
use App\Http\Controllers\Voyager\ContentTypes\SelectMultiple;
use App\Http\Controllers\Voyager\ContentTypes\Text;
use App\Http\Controllers\Voyager\ContentTypes\Timestamp;
use App\Models\Voyager\Campaign;
use TCG\Voyager\Traits\AlertsMessages;
use Validator;

abstract class FrontendBaseController extends BaseController
{
    use DispatchesJobs;
    use ValidatesRequests;
    use AuthorizesRequests;


    public function renderView($viewFile, $data)
    {
        return view($viewFile, $data)->render();
    }

    public function viewFolder()
    {
        return '';
    }

    public function parentViewFolder()
    {
        return 'frontend';
    }

}
