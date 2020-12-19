<?php declare(strict_types=1);

namespace Nkf\General\Utils;

class PathUtils
{
    public static function isDirectory(string $path) : bool
    {
        return is_dir($path);
    }

    public static function getFiles(string $pathDirectory) : array
    {
        assert(self::isDirectory($pathDirectory));
        $files = scandir($pathDirectory);
        foreach ($files as $key => $file)
            if ($file === '.' || $file === '..')
                unset($files[$key]);
        return $files;
    }

    public static function join() : string
    {
        $args = func_get_args();
        foreach ($args as $key => $arg)
            $args[$key] = trim($arg, '/');
        return join('/', $args);
    }

    public static function getContent(string $path)
    {
        return file_get_contents($path);
    }
}
