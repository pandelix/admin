<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Models\Type;
use App\Admin\Requests\TypeRequest;
use App\Admin\Resources\TypeResource;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::query()
            ->paginate();

        return $this->ok(TypeResource::collection($types));
    }

    public function create()
    {
        return $this->ok();
    }

    public function store(TypeRequest $request)
    {
        $inputs = $request->validated();
        $type = Type::create($inputs);

        return $this->created(TypeResource::make($type));
    }

    public function edit(Request $request, Type $type)
    {
        return $this->ok(TypeResource::make($type));
    }

    public function update(TypeRequest $request, Type $type)
    {
        $inputs = $request->validated();
        $type->update($inputs);

        return $this->created(TypeResource::make($type));
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return $this->noContent();
    }
}
