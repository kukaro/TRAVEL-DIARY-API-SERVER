<?php


namespace App\Http\Services\Classes;


use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Services\Interfaces\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FileServiceImpl implements FileService
{
    public function get(Request $request)
    {
        $path = $request->route()->catchall;
        $path = storage_path("app/$path");
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function post(RestRequest $request)
    {
        $file_path = $request->path;
        $file_part_path = explode("/", $file_path);
        $file_path = '';
        for ($i = 0; $i < count($file_part_path) - 1; $i++) {
            $file_path .= "/" . $file_part_path[$i];
        }
        $file_name = $file_part_path[count($file_part_path) - 1];
        $file = $request->req_file;
        $file->storeAs($file_path, $file_name);

        return response()->json([
            'MSG' => 'SUCCESS',
        ], 200);
    }

    //TODO : 나중에 파일 없을떄는 다른 메세지랑 코드 나가게 수정해야함
    public function delete(Request $request)
    {
        $path = $request->route()->catchall;
        $path = storage_path("app/$path");

        if (!File::exists($path)) {
            abort(404);
        }

        File::delete($path);

        return response()->json([
            'MSG' => 'SUCCESS',
        ], 200);
    }
}
