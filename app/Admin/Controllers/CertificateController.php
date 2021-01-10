<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Filters\CertificateFilter;
use App\Admin\Models\Certificate;
use App\Admin\Requests\CertificateRequest;
use App\Admin\Resources\CertificateResource;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(CertificateFilter $filter)
    {
        $certificates = Certificate::query()
            ->filter($filter)
            ->paginate();

        return $this->ok(CertificateResource::collection($certificates));
    }

    public function create()
    {
        return $this->ok();
    }

    public function store(CertificateRequest $request)
    {
        $inputs = $request->validated();
        $certificate = Certificate::create($inputs);

        return $this->created(CertificateResource::make($certificate));
    }

    public function edit(Request $request, Certificate $certificate)
    {
        return $this->ok(CertificateResource::make($certificate));
    }

    public function update(CertificateRequest $request, Certificate $certificate)
    {
        $inputs = $request->validated();
        $certificate->update($inputs);

        return $this->created(CertificateResource::make($certificate));
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return $this->noContent();
    }
}
