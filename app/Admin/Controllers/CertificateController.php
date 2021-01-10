<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Models\Certificate;
use App\Admin\Models\Company;
use App\Admin\Models\Type;
use App\Admin\Requests\CertificateRequest;
use App\Admin\Resources\CertificateResource;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::query()
            ->paginate();

        return $this->ok(CertificateResource::collection($certificates));
    }

    public function create()
    {
        return $this->ok($this->formData());
    }

    protected function formData()
    {
        return [
            'types' => Type::query()->get(),
            'companies' => Company::query()->get(),
        ];
    }

    public function store(CertificateRequest $request)
    {
        $inputs = $request->validated();
        $certificate = Certificate::create($inputs);

        return $this->created(CertificateResource::make($certificate));
    }

    public function edit(Request $request, Certificate $certificate)
    {
        return $this->ok(CertificateResource::make($certificate)->additional($this->formData()));
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
