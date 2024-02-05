<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait{

    public function responseSuccess($data, $message, $code):JsonResponse
    {
        return response()->json([
            'statusCode'=>true,
            'message'=>$message,
            'data'=>$data,
            'errors'=>null
        ], $code);
    }
    public function responseError($errors,$message, $code):JsonResponse
    {
        return response()->json([
            'status'=>false,
            'message'=>$message,
            'data'=>null,
            'errors'=>$errors
        ], $code);
    }
}


?>
