<?php declare(strict_types=1);

namespace Nkf\Laravel\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Nkf\General\Classes\BaseFormatter;
use Nkf\General\Classes\UrlHelper;
use Nkf\General\Utils\PathUtils;
use Storage;

trait TraitApiController
{
    protected function respondContent($data, int $status = 200) : JsonResponse
    {
        if (!is_array($data))
            $data = [$data];
        return response()->json($data, $status);
    }

    protected function responseWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'brear',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    protected function respondedFormatContent($data, BaseFormatter $formatter, array $parameters = []) : JsonResponse
    {
        return $this->respondContent($formatter->format($data, $parameters));
    }

    protected function respondedFormatListContent(iterable $list, BaseFormatter $formatter, array $parameters = []) : JsonResponse
    {
        return $this->respondContent($formatter->formatList($list, $parameters));
    }

    protected function respondedPaginate(Builder $query, BaseFormatter $formatter, int  $perPage) : JsonResponse
    {
        return $this->respondContent($formatter->formatPaginator($query->paginate($perPage)));
    }

    protected function saveBase64File(?string $base64Content) : ?string
    {
        $path = null;
        if ($base64Content !== null)
        {
            [$infoFile] = explode(';base64,', $base64Content);
            [$typeFile, $extension] = explode('/', str_replace('data:', '', $infoFile));
            $fileName = Carbon::now()->timestamp . "_$typeFile.$extension";
            $filePath = PathUtils::join('uploads', $fileName);
            // FIXME save file
            $isSave = Storage::drive('public')->append($filePath, base64_decode($base64Content));
            dump($isSave);
            if ($isSave)
                $path = app(UrlHelper::class)->getAbsolutePath($filePath);
        }
        return $path;
    }
}
