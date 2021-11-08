<?php declare(strict_types=1);

namespace Nkf\Laravel\Classes\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class ServerError extends Exception
{
    protected $errors;

    public function __construct($errors, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->errors = !is_array($errors) ? [$errors] : $errors;
    }

    public function render(Request $request) : JsonResponse
    {
        $result = [];
        foreach ($this->errors as $key => $errors)
        {
            if (is_array($errors))
            {
                foreach ($errors as $error)
                {
                    $result[$key][] = [
                        'code' => $error,
//                'message' => '', // TODO get message by code from lang file
                    ];
                }
            }
            else
            {
                $result[$key] = $errors;
            }
        }

        return response()->json(['errors' => $result])->setStatusCode(500);
    }
}
