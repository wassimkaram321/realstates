<?php

namespace App\Traits;

trait ResponseTrait
{
    public function error(){

        return response()->json([
            'error'=>true,
            'message'=>'something went wrong',
            'data' => []
        ]);
    }
    public function error_message($msg){

        return response()->json([
            'error'=>true,
            'message'=>$msg,
            'data' => []
        ]);
    }

    public function success($message,$data){

        return response()->json([
            'error'=>false,
            'message'=>$message,
            'data' => $data
        
        ]);
    }


}
