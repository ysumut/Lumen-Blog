<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginateCollection extends ResourceCollection
{
    public function additional($data)
    {
        return parent::additional([
            'status' => [
                'success' => $data[0],
                'messages' => $data[1]
            ]
        ]);
    }
}
