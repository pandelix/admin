<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Models\License;
use App\Admin\Models\Company;
use App\Admin\Models\Category;
use App\Admin\Requests\LicenseRequest;
use App\Admin\Resources\LicenseResource;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        $certificates = License::query()
            ->paginate();

        return $this->ok(LicenseResource::collection($certificates));
    }

    protected function formData()
    {
        return [
            'types' => Category::query()->get(),
            'companies' => Company::query()->get(),
        ];
    }

    public function create()
    {
        return $this->ok($this->formData());
    }

    public function store(LicenseRequest $request)
    {
        $inputs = $request->validated();
        $certificate = License::create($inputs);

        return $this->created(LicenseResource::make($certificate));
    }

    public function edit(Request $request, License $certificate)
    {
        return $this->ok(LicenseResource::make($certificate)->additional($this->formData()));
    }

    public function update(LicenseRequest $request, License $certificate)
    {
        $inputs = $request->validated();
        $certificate->update($inputs);

        return $this->created(LicenseResource::make($certificate));
    }

    public function destroy(License $certificate)
    {
        $certificate->delete();
        return $this->noContent();
    }
}
