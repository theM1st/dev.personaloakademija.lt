<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForMaintenanceMode {
/*
    protected $request;
    protected $app;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    public function handle($request, Closure $next)
    {
        if ($request->get('maintenance')) {
            if ($this->app->isDownForMaintenance()) {
                unlink($this->app->storagePath().DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'down');
            } else {
                fopen($this->app->storagePath().DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'down', 'w');
            }
        }

        if ($this->app->isDownForMaintenance())
        {
            abort(503);
        }

        if ($this->app->isDownForMaintenance() &&
            !in_array($this->request->getClientIp(), ['86.10.190.248', '86.4.7.24']))
        {
            return response('Be right back!', 503);
        }

        return $next($request);
    }
  */
}
