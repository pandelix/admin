<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Filters\RuleFilter;
use App\Admin\Models\Rule;
use App\Admin\Requests\RuleRequest;
use App\Admin\Resources\RuleResource;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index(RuleFilter $filter)
    {
        $rules = Rule::query()
//            ->filter($filter)
            ->paginate();

        return $this->ok(RuleResource::collection($rules));
    }

    public function create()
    {
        return $this->ok();
    }

    public function store(RuleRequest $request)
    {
        $inputs = $request->validated();
        $rule = Rule::create($inputs);

        return $this->created(RuleResource::make($rule));
    }

    public function edit(Request $request, Rule $rule)
    {
        return $this->ok(RuleResource::make($rule));
    }

    public function update(RuleRequest $request, Rule $rule)
    {
        $inputs = $request->validated();
        $rule->update($inputs);

        return $this->created(RuleResource::make($rule));
    }

    public function destroy(Rule $rule)
    {
        $rule->delete();
        return $this->noContent();
    }
}
