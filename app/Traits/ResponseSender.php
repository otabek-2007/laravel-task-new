<?php

namespace App\Traits;

trait ResponseSender
{

    public function sendResponse($data = [], $message = "", $status_code = 200, $errors = [])
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'errors' => $errors,
            'message' => $message
        ]);
        $status_code;
    }
    public function sendError($data = null, $message = "", $status_code = 400, $errors = [])
    {
        return response()->json([
            'status' => 'error',
            'data' => $data,
            'errors' => $errors,
            'message' => $message
        ]);
        $status_code;
    }
}
