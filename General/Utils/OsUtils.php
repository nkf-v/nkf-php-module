<?php declare(strict_types=1);


namespace Nkf\General\Utils;


class OsUtils
{
    public static function isWindows() : bool
    {
        return StringUtils::startWith(strtolower(PHP_OS), 'win');
    }
}
