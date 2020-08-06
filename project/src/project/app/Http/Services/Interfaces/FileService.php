<?php

namespace App\Http\Services\Interfaces;

use Illuminate\Http\Request;

interface FileService
{
    public function get(Request $request);

    public function post(Request $request);

    public function delete(Request $request);
}
