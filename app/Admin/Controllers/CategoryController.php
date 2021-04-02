<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Models\Category;
use App\Admin\Requests\CategoryRequest;
use App\Admin\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->paginate();
        return $this->ok(CategoryResource::collection($categories));
    }

    public function create()
    {
        echo 123;
        return $this->ok();
    }

    public function store(CategoryRequest $request)
    {
        $inputs = $request->validated();
        $category = Category::create($inputs);

        return $this->created(CategoryResource::make($category));
    }

    public function edit(Request $request, Category $category)
    {
        return $this->ok(CategoryResource::make($category));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $inputs = $request->validated();
        $category->update($inputs);

        return $this->created(CategoryResource::make($category));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->noContent();
    }
}
