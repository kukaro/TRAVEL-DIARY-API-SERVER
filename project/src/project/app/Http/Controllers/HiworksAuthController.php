<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\TravleDiaryService;
use Illuminate\Routing\Controller as BaseController;

class HiworksAuthController extends TravleDiaryController
{

    /**
     * Class constructor.
<<<<<<< HEAD
     * @param TravleDiaryService $service
     * @param RestRequest $request
=======
>>>>>>> 499388279af6a3a2256564b8bd3aef82b527cb8b
     */
    public function __construct(TravleDiaryService $service, RestRequest $request)
    {
        parent::__construct($service, $request);
    }
<<<<<<< HEAD

    public function get()
    {
        $data = $this->service->get($this->request);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post()
    {
        $data = $this->service->post($this->request);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function patch()
    {
        $this->service->patch($this->request);
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function delete()
    {
        $this->service->delete($this->request);
        return response()->json(['data' => 'SUCCESS'], 200, [], JSON_UNESCAPED_UNICODE);
    }
=======
>>>>>>> 499388279af6a3a2256564b8bd3aef82b527cb8b
}
