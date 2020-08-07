<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Http\UploadedFile;

interface FileRepository
{
    public function get(string $path);

    public function post(string $path, UploadedFile $file);

    public function delete(string $path);
}
