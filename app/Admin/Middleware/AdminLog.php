<?php

namespace App\Admin\Middleware;

use App\Admin\Models\AdminLog as AdminLogModel;
use App\Admin\Models\AdminLogOutput;
use App\Admin\Traits\UrlWhitelist;
use App\Admin\Utils\Admin;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AdminLog
{
    use UrlWhitelist;

    protected $urlWhitelist = [
        'GET:/configs/system_basic/values',
        'GET:/admin-logs',
        '/configs/cache',
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->shouldPassThrough($request)) {
            return $next($request);
        }

        $uuid = Str::orderedUuid();
        $insert = [
            'uuid' => $uuid,
            'admin_user_id' => Admin::user()->id,
            'admin_name' => Admin::user()->name,
            'admin_username' => Admin::user()->username,
            'ip' => $request->ip(),
            'route' => $request->route()->getName(),
            'method' => $request->method(),
            'url' => $request->url(),
            'input' => $request->input(),
        ];

        /** @var \Illuminate\Http\Response $res */
        $res = $next($request);

        $insert = array_merge($insert, [
            'status_code' => $res->getStatusCode(),
        ]);

        $adminLog = AdminLogModel::query()->create($insert);
        if ($this->shouldRecordOutput($request, $res)) {
            AdminLogOutput::query()->create([
                'log_uuid' => $uuid,
                'output' => json_decode($res->getContent(), true),
            ]);
        }

        return $res;
    }

    protected function urlWhitelist(): array
    {
        return array_map(function ($url) {
            return Admin::urlWithMethod($url);
        }, $this->urlWhitelist);
    }

    protected function shouldRecordOutput(Request $request, Response $response)
    {
        if ($request->routeIs('admin.admin-logs.index')) {
            return false;
        }

        if (!$response instanceof JsonResponse) {
            return false;
        }

        if ($response->getContent() === '') {
            return false;
        }

        return true;
    }
}
