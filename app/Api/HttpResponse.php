<?php

namespace App\Api;


trait HttpResponse
{
    public function fail( $status = 'fail', $statusCode = 400, $message, $data)
    {
        return response()->json([
            'status' => $status,
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function success( $status = 'success', $statusCode = 200, $message, $data)
    {
        return response()->json([
            'status' => $status,
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
