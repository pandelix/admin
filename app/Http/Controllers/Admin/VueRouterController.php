<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VueRouterRequest;
use App\Http\Resources\VueRouterResource;
use App\Models\VueRouter;
use Illuminate\Http\Request;

class VueRouterController extends AdminBaseController
{
    public function store(VueRouterRequest $request, VueRouter $model)
    {
        $inputs = $request->validated();
        $res = $model->create($inputs);
        return $this->created(VueRouterResource::make($res));
    }

    public function update(VueRouterRequest $request, VueRouter $vueRouter)
    {
        $inputs = $request->validated();
        $vueRouter->update($inputs);

        return $this->created(VueRouterResource::make($vueRouter));
    }

    public function edit(VueRouter $vueRouter)
    {
        return VueRouterResource::make($vueRouter);
    }

    public function index()
    {
        return $this->ok(VueRouter::buildNestedArray());
    }

    public function destroy(VueRouter $vueRouter)
    {
        $vueRouter->delete();
        return $this->noContent();
    }
}
