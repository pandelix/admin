<?php

namespace App\Admin\Resources;

use App\Admin\Models\Company;
use App\Admin\Models\Type;
use App\Admin\Resources\JsonResource;

class CertificateResource extends JsonResource
{
    public function toArray($request)
    {

        $data = [
            'types' => Type::all(),
            'companies' => Company::all(),
        ];

        return array_merge(parent::toArray($request), $data);
    }
}
