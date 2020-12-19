<?php declare(strict_types=1);

namespace Nkf\General\Classes;

use ReflectionClass;

class BaseEnums
{
    public static function getVariables() : array
    {
        return (new ReflectionClass(static::class))->getConstants();
    }
}
