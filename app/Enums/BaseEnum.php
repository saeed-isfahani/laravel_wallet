<?php

namespace App\Enums;

trait BaseEnum
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}