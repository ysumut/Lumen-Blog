<?php

namespace App\Http\Resources;

class Collection
{
    private $data, $status;

    public function __construct($data, $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
    }

    public function add(bool $success, array $messages)
    {
        return response([
            'data' => $this->data,
            'status' => [
                'success' => $success,
                'messages' => $messages
            ]
        ], $this->status);
    }
}
