<?php declare(strict_types=1);

namespace Nkf\General\Utils;

final class ArrayUtils
{
    public static function randomValue(array $values)
    {
        return $values[array_rand($values)];
    }

    public static function randomValues(array $values, ?int $count = null) : array
    {
        if ($count === null)
            $count = random_int(1, count($values));

        $result = [];
        do
        {
            $result[] = self::randomValue($values);
        }
        while (count($result) !== $count);
        return $result;
    }

    public static function toArray(iterable $values)
    {
        if (is_array($values))
            return $values;

        $result = [];
        foreach ($values as $value)
            $result[] = $value;

        return $result;
    }
}
