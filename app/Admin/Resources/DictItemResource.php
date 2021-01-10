<?php

namespace App\Admin\Resources;

use App\Admin\Resources\JsonResource;

class DictItemResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
