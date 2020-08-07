<?php


namespace App\Http\Services\Classes;


use App\Http\Repositories\Interfaces\FileRepository;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\FileService;
use Illuminate\Http\Request;

class FileServiceImpl implements FileService
{
    private FileRepository $repository;

    public function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(Request $request)
    {
        $path = $request->route()->catchall;
        return $this->repository->get($path);
    }

    public function post(RestRequest $request)
    {
        $this->repository->post($request->path, $request->req_file);

        return response()->json([
            'MSG' => 'SUCCESS',
        ], 200);
    }

    //TODO : 나중에 파일 없을떄는 다른 메세지랑 코드 나가게 수정해야함
    public function delete(Request $request)
    {
        $path = $request->route()->catchall;
        $this->repository->delete($path);

        return response()->json([
            'MSG' => 'SUCCESS',
        ], 200);
    }
}
