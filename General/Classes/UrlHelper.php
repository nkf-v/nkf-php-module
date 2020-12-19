<?php declare(strict_types=1);

namespace Nkf\General\Classes;

use Nkf\General\Utils\PathUtils;
use Storage;

class UrlHelper
{
    public function getAbsolutePath(?string $path) : string
    {
        return url($path);
    }

    public function getAbsolutPublicPath(?string $path) : ?string
    {
        return $this->getAbsolutePath(PathUtils::join('public', $path));
    }
}
