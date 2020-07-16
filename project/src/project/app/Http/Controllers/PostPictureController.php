<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\TravleDiaryService;
use Illuminate\Routing\Controller as BaseController;

class PostPictureController extends TravleDiaryController
{

    /**
     * Class constructor.
     */
    public function __construct(TravleDiaryService $service, RestRequest $request)
    {
        parent::__construct($service, $request);
    }
}
