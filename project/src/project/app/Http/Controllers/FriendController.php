<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\TravleDiaryService;
use App\Util\DB\ErrorType;
use Illuminate\Routing\Controller as BaseController;

class FriendController extends TravleDiaryController
{

    /**
     * Class constructor.
     * @param TravleDiaryService $service
     * @param RestRequest $request
     */
    public function __construct(TravleDiaryService $service, RestRequest $request)
    {
        parent::__construct($service, $request);
    }

    public function get()
    {
        $data = $this->service->get($this->request);
        return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function post()
    {
        $data = $this->service->post($this->request);
        if($data instanceof ErrorType){
            return response()->json(['data' => $data], $data->getStatus(), [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
