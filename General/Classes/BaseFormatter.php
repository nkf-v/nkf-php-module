<?php declare(strict_types=1);

namespace Nkf\General\Classes;

use App\Formatters\Common\PaginateFormatter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class BaseFormatter
{
    /** @var callable */
    private $callbackFormat;

    public function setFormatter(callable $callback) : void
    {
        $this->callbackFormat = $callback;
    }

    public function format($item, array $parameters = []) : array
    {
        return call_user_func_array($this->callbackFormat, array_merge([$item], $parameters));
    }

    public function formatList(iterable $list, array $parameters = []) : array
    {
        $result = [];
        foreach ($list as $item)
            $result[] = $this->format($item, $parameters);
        return $result;
    }

    public function formatPaginator(LengthAwarePaginator $paginator)
    {
        return [
            'items' => $this->formatList($paginator->items()),
            'items_total' => $paginator->total(),
            'page_current' => $paginator->currentPage(),
            'page_last' => $paginator->lastPage(),
            'page_size' => $paginator->perPage(),
        ];
    }
}
