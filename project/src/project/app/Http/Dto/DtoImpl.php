<?php

namespace App\Http\Dto;

abstract class DtoImpl implements Dto
{
    private $joins = [];
    public function addJoin(Join $join)
    {
        $joins[$join->target_table_name] = $join;
    }
}
