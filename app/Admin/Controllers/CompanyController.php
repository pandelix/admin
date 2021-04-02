<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Models\License;
use App\Admin\Models\Company;
use App\Admin\Models\Category;
use App\Admin\Requests\CompanyRequest;
use App\Admin\Resources\CompanyResource;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companys = Company::query()
            ->paginate();

        return $this->ok(CompanyResource::collection($companys));
    }

    protected function formData()
    {
        return [
            'categories' => Category::query()->get(),
            'licenses' => License::query()->where('category_id', 1)->where('company_id', 0)->get(),
            'parent_companies' => Company::query()->where('correlation', [1, 2])->get()
        ];
    }

    public function create()
    {
        return $this->ok($this->formData());
    }

    public function store(CompanyRequest $request)
    {
        $inputs = $request->validated();
        $company = Company::create($inputs);
        return $this->created(CompanyResource::make($company));
    }

    public function edit(Request $request, Company $company)
    {
        return $this->ok(CompanyResource::make($company)->additional($this->formData()));
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
