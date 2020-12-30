<?php declare(strict_types=1);

namespace Nkf\General\Classes;

use ReflectionClass;

abstract class BaseEnums
{
    public static function getVariables() : array
    {
        return array_change_key_case((new ReflectionClass(static::class))->getConstants());
    }

    public static function getValues() : array
    {
        return array_flip(self::getVariables());
    }

    abstract static public function getLabels() : array;

    abstract static public function getLabelValue(int $value);
}
