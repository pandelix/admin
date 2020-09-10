<?php

namespace App\Admin\Controllers;

use App\Admin\Filters\AdminLogFilter;
use App\Admin\Models\AdminLog;
use App\Admin\Requests\AdminLogRequest;
use App\Admin\Resources\AdminLogResource;
use Illuminate\Http\Request;

class AdminLogController extends Controller
{
    public function index(AdminLogFilter $filter)
    {
        $adminLogs = AdminLog::query()
            ->filter($filter)
            ->with(['adminUser:id,name,username', 'output'])
            ->orderByDesc('uuid')
            ->paginate();

        return $this->ok(AdminLogResource::collection($adminLogs));
    }

    public function destroy(Request $request, string $uuid)
    {
        AdminLog::query()->where('uuid', $uuid)->delete();
        return $this->noContent();
    }

    public function batchDestroy(Request $request)
    {
        AdminLog::query()->whereIn('uuid', $request->input('uuid'))->delete();
        return $this->noContent();
    }
}
