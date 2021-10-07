<?php

class Helper
{

    public static function jsonResponse($status, $message, $data=""){
        echo json_encode(['response'=>[
            'message' => $message,
            'status' => $status,
            'data' => $data
        ]]);
    }

}