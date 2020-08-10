<?php


namespace App\Http\Services\Classes;


use App\Http\Repositories\Interfaces\FileRepository;
use App\Http\Services\Interfaces\FileService;
use Illuminate\Http\UploadedFile;

class FileServiceImpl implements FileService
{
    private FileRepository $repository;

    public function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(string $path)
    {
        return $this->repository->get($path);
    }

    public function post(string $path, UploadedFile $file)
    {
        $this->repository->post($path, $file);

        return response()->json([
            'MSG' => 'SUCCESS',
        ], 200);
    }

    //TODO : 나중에 파일 없을떄는 다른 메세지랑 코드 나가게 수정해야함
    public function delete(string $path)
    {
        $this->repository->delete($path);

        return response()->json([
            'MSG' => 'SUCCESS',
        ], 200);
    }
}
