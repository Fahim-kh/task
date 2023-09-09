<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result , $msg){
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $msg,
        ];
        return response()->json($response, 200);
    }
    public function sendError($result, $error, $errorMessages = [], $code = 200)
    {
        $response = [
            'success' => false,
            'data' => $result,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
