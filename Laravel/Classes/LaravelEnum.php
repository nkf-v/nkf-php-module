<?php declare(strict_types=1);

namespace Nkf\Laravel\Classes;

use Nkf\General\Classes\BaseEnum;

class LaravelEnum extends BaseEnum
{
    // TODO Перенести в другой класс, enum не должен тметь эти функции поскольку это не его задачи
    static public function getLabels() : array
    {
        return trans(sprintf('enums.%s', static::class));
    }

    static public function getLabelValue(int $value) : string
    {
        return trans(sprintf('enums.%s.%d', static::class, $value));
    }
}
