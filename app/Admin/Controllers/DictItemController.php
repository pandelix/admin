<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Filters\DictItemFilter;
use App\Admin\Models\DictItem;
use App\Admin\Requests\DictItemRequest;
use App\Admin\Resources\DictItemResource;
use Illuminate\Http\Request;

class DictItemController extends Controller
{
    public function index(DictItemFilter $filter)
    {
        $dictItems = DictItem::query()
            ->filter($filter)
            ->paginate();

        return $this->ok(DictItemResource::collection($dictItems));
    }

    public function create()
    {
        return $this->ok();
    }

    public function store(DictItemRequest $request)
    {
        $inputs = $request->validated();
        $dictItem = DictItem::create($inputs);

        return $this->created(DictItemResource::make($dictItem));
    }

    public function edit(Request $request, DictItem $dictItem)
    {
        return $this->ok(DictItemResource::make($dictItem));
    }

    public function update(DictItemRequest $request, DictItem $dictItem)
    {
        $inputs = $request->validated();
        $dictItem->update($inputs);

        return $this->created(DictItemResource::make($dictItem));
    }

    public function destroy(DictItem $dictItem)
    {
        $dictItem->delete();
        return $this->noContent();
    }
}
