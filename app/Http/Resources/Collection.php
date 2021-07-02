<?php

namespace App\Http\Resources;

class Collection
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function add(bool $success, array $messages): array
    {
        return [
            'data' => $this->data,
            'status' => [
                'success' => $success,
                'messages' => $messages
            ]
        ];
    }
}
