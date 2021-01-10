<?php

namespace App\Admin\Resources;

use App\Admin\Resources\JsonResource;

class RemindResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
