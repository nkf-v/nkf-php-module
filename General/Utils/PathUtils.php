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

    public static function join(...$paths) : string
    {
        $result = [];
        foreach ($paths as $key => $path)
        {
            foreach (self::splitPath($path) as $pathPart)
            {
                $strippedPath = self::trimSeparators(self::normalizePath($pathPart));
                if ($strippedPath)
                    $result[] = $strippedPath;
            }
        }

        return self::getLeadingSeparator($paths[0]) . join(DIRECTORY_SEPARATOR, $paths);
    }

    public static function getContent(string $path)
    {
        return file_get_contents($path);
    }

    public static function isUncPath(string $path) : bool
    {
        return StringUtils::startWith($path, '\\\\');
    }

    public static function splitPath(string $path) : array
    {
        return explode(DIRECTORY_SEPARATOR, self::normalizePath($path));
    }

    public static function normalizePath(string $path) : string
    {
        return self::getLeadingSeparator($path) . self::trimSeparators(preg_replace('~[\\\/]~', DIRECTORY_SEPARATOR, $path));
    }

    public static function getLeadingSeparator(string $path) : string
    {
        $result = null;
        if (OsUtils::isWindows())
            $result = self::isUncPath($path) ? '\\\\' : '';
        else
            $result = (($path[0] ?? '') === '/') ? '/' : '';

        return $result;
    }

    public static function trimSeparators(string $path) : string
    {
        return trim($path, '\\/');
    }
}
