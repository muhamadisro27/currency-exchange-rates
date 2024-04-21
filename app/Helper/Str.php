<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Response;

class Str
{
    public function getMode($data)
    {
        $str = [
            [
                'title' => 'Create',
                'button' => 'Submit'
            ],
            [
                'title' => 'Edit',
                'button' => 'Save Changes'
            ]
        ];

        $mode = isset($data->id) ? $str[1] : $str[0];

        return $mode;
    }

    public function initial_response($message, $status = Response::HTTP_OK, $data = null)
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }

    public function is_value_null($value)
    {
        if ($value) {
            return $value;
        }

        return '-';
    }
}
