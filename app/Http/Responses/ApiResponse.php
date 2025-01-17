<?php

namespace App\Http\Responses;

use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class ApiResponse
{
    public static function sendError(Exception $error, string $message = 'Something went wrong!')
    {
        $response = [
            'success' => false,
            'message' => $message,
            'data' => $error
        ];

        throw new HttpResponseException(response()->json($response, 500));
    }

    public static function sendResponse($result, int $code = 200, string $message = '')
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result
        ];

        return response()->json($response, $code);
    }
}
