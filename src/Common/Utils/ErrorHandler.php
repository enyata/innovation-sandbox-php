<?php

namespace InnovationSandbox\Common\Utils;

class ErrorHandler
{
    public static function apiError($e)
    {
        $errorResponse = $e->getResponse();
        if ($errorResponse) {
            $message = ($e->getResponse()->getBody() == '' ?  'Bad Request' : json_decode($e->getResponse()->getBody()));
            $statusCode = $e->getResponse()->getStatusCode();
            switch ($statusCode) {
                case 400: {
                        return [
                            'error' => $message,
                            'statusCode' => $statusCode
                        ];
                    }
                case 401: {
                        return [
                            'error' => 'Unauthorized. Please check your credentials.',
                            'statusCode' => $statusCode
                        ];
                    }
                case 403: {
                        return [
                            'error' => 'Expired/Invalid Sanbox Key.',
                            'statusCode' => $statusCode
                        ];
                    }
                case 503: {
                        return [
                            'error' => 'Service temporarily unavailable',
                            'statusCode' => $statusCode
                        ];
                    }
                default: {
                        return [
                            'error' => 'Error executing methodName, Please raise an issue on Github.',
                            'statusCode' => '500'
                        ];
                    }
            }
        }
        return [
            'message' => 'Something went wrong, Please raise an issue on Github using the stack trace',
            'error' => $e->getMessage()
        ];
    }

    public static function moduleError($e)
    {
        return [
            'message' => 'Something went wrong, Please raise an issue on Github using the stack trace',
            'error' => $e->getMessage()
        ];
    }
}
