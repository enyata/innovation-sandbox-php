<?php

namespace InnovationSandbox\Common\Utils;

class ErrorHandler {
    public static function apiError($e) {
        $errorResponse = $e->getResponse();
        if($errorResponse){     
            $message = $e->getResponse()->getBody();
            return [
                'error' => $message,
                'statusCode' => $e->getCode()
            ];
                
        } else {
            return [
                'message' => 'Something went wrong, Please raise an issue on Github using the stack trace',
                'error' => $e->getMessage()
            ];
        }
    }

    public static function moduleError($e){
        return [
            'message' => 'Something went wrong, Please raise an issue on Github using the stack trace',
            'error' => $e->getMessage()
        ];
    }
}