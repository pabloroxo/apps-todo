<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // 200
    protected function responseOk($data)
    {
        return response()->json(
            [
                'data' => $data,
                'error' => null,
            ],
            Response::HTTP_OK,
        );
    }

    // 201
    protected function responseCreated($data)
    {
        return response()->json(
            [
                'data' => $data,
                'error' => null,
            ],
            Response::HTTP_CREATED,
        );
    }
}
