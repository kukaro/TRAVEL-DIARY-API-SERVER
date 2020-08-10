<?php

namespace App\Http\Services\Interfaces;

use Illuminate\Http\UploadedFile;

interface FileService
{
    public function get(string $path);

    public function post(string $path, UploadedFile $file);

    public function delete(string $path);
}
