<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Page;
use App\TopCvProfile;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to your controller routes.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * @var string
	 */
	protected $authNamespace = 'App\Http\Controllers\Auth';

	/**
	 * @var string
	 */
	protected $adminNamespace = 'App\Http\Controllers\Admin';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot()
	{
		parent::boot();

		$this->bootRouteModelBinders();
	}

	private function bootRouteModelBinders()
	{
		Route::model('page', Page::class);
		Route::model('topCvProfile', TopCvProfile::class);
		Route::bind('pageSlug', function($slug) {
			return Page::where('slug_'.\Lang::getLocale(), $slug)->first();
		});
        Route::bind('cvNumber', function($cvNumber) {
            $cv = TopCvProfile::where('cv_number', $cvNumber)->first();
            if (!$cv) {
                abort(404);
            }

            return $cv;
        });
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map()
	{
		$this->mapApiRoutes();

		$this->mapWebRoutes();

		$this->mapAdminRoutes();
		//
	}

	/**
	 * Define the "web" routes for the application.
	 *
	 * These routes all receive session state, CSRF protection, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	protected function mapWebRoutes()
	{
		Route::group([
			'middleware' => 'web',
			'namespace' => $this->namespace,
		], function ($router) {
			require base_path('routes/web.php');
		});

		Route::group([
			'middleware' => 'web',
			'namespace' => $this->authNamespace,
			'prefix' => 'auth',
		], function ($router) {
			require base_path('routes/auth.php');
		});
	}

	/**
	 * Define the "api" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapApiRoutes()
	{
		Route::group([
			'middleware' => 'api',
			'namespace' => $this->namespace,
			'prefix' => 'api',
		], function ($router) {
			require base_path('routes/api.php');
		});
	}

	/**
	 * Define the "api" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapAdminRoutes()
	{
		Route::group([
			'middleware' => 'admin',
			'as' => 'admin.',
			'namespace' => $this->adminNamespace,
			'prefix' => 'admin',
		], function ($router) {
			require base_path('routes/admin.php');
		});
	}
}
