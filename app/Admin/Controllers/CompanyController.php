<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Filters\CompanyFilter;
use App\Admin\Models\Company;
use App\Admin\Requests\CompanyRequest;
use App\Admin\Resources\CompanyResource;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(CompanyFilter $filter)
    {
        $companys = Company::query()
            ->filter($filter)
            ->paginate();

        return $this->ok(CompanyResource::collection($companys));
    }

    public function create()
    {
        return $this->ok();
    }

    public function store(CompanyRequest $request)
    {
        $inputs = $request->validated();
        $company = Company::create($inputs);

        return $this->created(CompanyResource::make($company));
    }

    public function edit(Request $request, Company $company)
    {
        return $this->ok(CompanyResource::make($company));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $inputs = $request->validated();
        $company->update($inputs);

        return $this->created(CompanyResource::make($company));
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return $this->noContent();
    }
}
