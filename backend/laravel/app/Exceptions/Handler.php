<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof Exception) {
            $error = [ $exception->getMessage() ];
        }

        if ($exception instanceof ArrayException) {
            $error = $exception->getMessages();
        }

        return response()->json(
            [
                'data' => null,
                'error' => $error,
            ],
            $exception->getCode(),
        );
    }
}
