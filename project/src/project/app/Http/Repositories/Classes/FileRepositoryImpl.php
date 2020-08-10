<?php


namespace App\Http\Repositories\Classes;


use App\Exceptions\FileNotExistsException;
use App\Http\Repositories\Interfaces\FileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FileRepositoryImpl implements FileRepository
{
    /**
     * @param string $path
     * @return \Illuminate\Http\Response
     * @throws FileNotExistsException exception
     */
    public function get(string $path){
        $path = storage_path("app/$path");
        if (!File::exists($path)) {
            throw new FileNotExistsException($path);
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function post(string $path, UploadedFile $file){
        $file_path = $path;
        $file_part_path = explode("/", $file_path);
        $file_path = '';
        for ($i = 0; $i < count($file_part_path) - 1; $i++) {
            $file_path .= "/" . $file_part_path[$i];
        }
        $file_name = $file_part_path[count($file_part_path) - 1];
        $file->storeAs($file_path, $file_name);

        return response()->json([
            'MSG' => 'SUCCESS',
        ], 200);
    }

    /**
     * @param string $path
     * @return \Illuminate\Http\JsonResponse
     * @throws FileNotExistsException
     */
    public function delete(string $path){
        $path = storage_path("app/$path");

        if (!File::exists($path)) {
            throw new FileNotExistsException($path);
        }

        File::delete($path);

        return response()->json([
            'MSG' => 'SUCCESS',
        ], 200);
    }
}
