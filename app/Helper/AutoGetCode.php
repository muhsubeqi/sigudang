<?php

namespace App\Helper;

class AutoGetCode
{
    public static function store($query, $name = 'B', $columnName = 'code'){
        $lastCode = $query->orderBy('created_at', 'desc')->first();
        $nextCode = $name . str_pad(($lastCode ? (int)substr($lastCode->$columnName, 2) + 1 : 1), 5, '0', STR_PAD_LEFT);
        return $nextCode;
    }
}
