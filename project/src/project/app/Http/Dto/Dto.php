<?php

namespace App\Http\Dto;

interface Dto extends \JsonSerializable
{
    public function jsonSerialize();
}
