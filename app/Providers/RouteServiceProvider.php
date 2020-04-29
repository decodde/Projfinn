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

        //Account
        $this->mapAccountRoutes();

        //Web
        $this->mapWebRoutes();

        //Auth
        $this->mapAuthRoutes();


        //Lender
        $this->mapLenderRoutes();

        //Business
        $this->mapBusinessRoutes();

        //BVN
        $this->mapBvnRoutes();

        //Dashboard
        $this->mapDashboardRoutes();

        //Document
        $this->mapDocumentRoutes();

        //Investment
        $this->mapInvestmentRoutes();

        //Transaction
        $this->mapTransactionRoutes();
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
        Route::middleware(['web', 'guest'])
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
    protected function mapDashboardRoutes()
    {
        Route::prefix('dashboard')
            ->middleware(['web', 'user'])
            ->namespace($this->namespace.'\Dashboard')
            ->group(base_path('routes/dashboard.php'));
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


    /**
     * Define the "BVN" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapBvnRoutes()
    {
        Route::prefix('bvn')
            ->middleware('web')
            ->namespace($this->namespace.'\Bvn')
            ->group(base_path('routes/bvn.php'));
    }


    /**
     * Define the "Document" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDocumentRoutes()
    {
        Route::prefix('documents')
            ->middleware(['web', 'user'])
            ->namespace($this->namespace.'\Document')
            ->group(base_path('routes/document.php'));
    }


    /**
     * Define the "Document" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapTransactionRoutes()
    {
        Route::prefix('transaction')
            ->middleware(['web', 'user'])
            ->namespace($this->namespace.'\Transaction')
            ->group(base_path('routes/transaction.php'));
    }

    /**
     * Define the "Document" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAccountRoutes()
    {
        Route::prefix('account')
            ->middleware(['web', 'user'])
            ->namespace($this->namespace.'\Account')
            ->group(base_path('routes/account.php'));
    }


    /**
     * Define the "Investment" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapInvestmentRoutes()
    {
        Route::prefix('investment')
            ->middleware(['web', 'user'])
            ->namespace($this->namespace.'\Investment')
            ->group(base_path('routes/investment.php'));
    }
}
