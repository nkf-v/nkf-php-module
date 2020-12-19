<?php declare(strict_types=1);

namespace Nkf\General\Utils;

class ArrayUtils
{
    public static function randomValue(array $values)
    {
        return $values[array_rand($values)];
    }
}
