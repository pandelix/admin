<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use App\Admin\Models\Remind;
use App\Admin\Requests\RemindRequest;
use App\Admin\Resources\RemindResource;
use Illuminate\Http\Request;

class RemindController extends Controller
{
    public function index()
    {
        $reminds = Remind::query()
            ->paginate();

        return $this->ok(RemindResource::collection($reminds));
    }

    public function create()
    {
        return $this->ok();
    }

    public function store(RemindRequest $request)
    {
        $inputs = $request->validated();
        $remind = Remind::create($inputs);

        return $this->created(RemindResource::make($remind));
    }

    public function edit(Request $request, Remind $remind)
    {
        return $this->ok(RemindResource::make($remind));
    }

    public function update(RemindRequest $request, Remind $remind)
    {
        $inputs = $request->validated();
        $remind->update($inputs);

        return $this->created(RemindResource::make($remind));
    }

    public function destroy(Remind $remind)
    {
        $remind->delete();
        return $this->noContent();
    }
}
