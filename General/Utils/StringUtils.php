<?php declare(strict_types=1);

namespace Nkf\General\Utils;

class StringUtils
{
    public static function startWith(string $value, string $prefix) : bool
    {
        $result = false;
        if ($value !== '' && $prefix !== '')
            $result = mb_substr($value, 0, mb_strlen($prefix)) === $prefix;
        return $result;
    }
}
