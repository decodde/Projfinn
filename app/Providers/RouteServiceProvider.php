<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        //Api
        $this->mapApiRoutes();

        //Web
        $this->mapWebRoutes();

        //Auth
        $this->mapAuthRoutes();


        //Lender
        $this->mapLenderRoutes();

        //Business
        $this->mapBusinessRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
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
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "auth" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAuthRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace.'\Auth')
            ->group(base_path('routes/auth.php'));
    }

    /**
     * Define the "lender" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapLenderRoutes()
    {
        Route::prefix('lender')
            ->middleware('web')
            ->namespace($this->namespace.'\Lender')
            ->group(base_path('routes/lender.php'));
    }
    /**
     * Define the "lender" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapBusinessRoutes()
    {
        Route::prefix('business')
            ->middleware('web')
            ->namespace($this->namespace.'\Business')
            ->group(base_path('routes/business.php'));
    }
}
