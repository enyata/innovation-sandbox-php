<?php

namespace InnovationSandbox\Common\Utils;

class ErrorHandler {
    public static function apiError($e){
        $errorResponse = $e->getResponse();
        if($errorResponse){
            $statusCode = $e->getResponse()->getStatusCode();
            switch ($statusCode) {
                case 400: {
                    return [
                        "message"=> 'Bad request', 
                        "statusCode" => $statusCode 
                ];
                }
                case 401: {
                    return [
                        "message"=> 'Unauthorized. Please check your credentials.', 
                        "statusCode" => $statusCode
                ];
                }
                case 403: {
                    return [
                        "message"=> 'Expired/Invalid Sanbox Key.', 
                        "statusCode" => $statusCode
                ];
                }
                case 503: {
                    return [
                        "message"=> 'Service temporarily unavailable', 
                        "statusCode" => $statusCode
                ];
                }
                default: {
                    return [
                        "message" => "Error executing methodName, Please raise an issue on Github.", 
                        "statusCode" => "500"
                    ];
                }
            }
        }
        return [
            "message" => "Something went wrong, Please raise an issue on Github using the stack trace",
            "error" => $e->getMessage()
        ];
    }

    public static function moduleError($e){
        return [
            "message" => "Something went wrong, Please raise an issue on Github using the stack trace",
            "error" => $e->getMessage()
        ];
    }
}