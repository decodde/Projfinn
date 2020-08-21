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
        //Admin
        $this->mapAdminRoutes();

        //Api
        $this->mapApiRoutes();

        //Account
        $this->mapAccountRoutes();

        //Cron
        $this->mapCronRoutes();

        //Web
        $this->mapWebRoutes();

        //Auth
        $this->mapAuthRoutes();

        //Funds
        $this->mapFundsRoutes();

        //Introducer
        $this->mapIntroducerRoutes();

        //Lender
        $this->mapLenderRoutes();

        //Guarantor
        $this->mapGuarantorRoutes();

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
     * Define the "cron" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapCronRoutes()
    {
        Route::prefix('cron')
            ->middleware(['web'])
            ->namespace($this->namespace.'\Cron')
            ->group(base_path('routes/cron.php'));
    }

    /**
     * Define the "auth" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapFundsRoutes()
    {
        Route::prefix('funds')
            ->middleware(['web', 'user'])
            ->namespace($this->namespace.'\Funds')
            ->group(base_path('routes/funds.php'));
    }

    /**
     * Define the "auth" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapIntroducerRoutes()
    {
        Route::prefix('introducer')
            ->middleware(['web'])
            ->namespace($this->namespace.'\Introducer')
            ->group(base_path('routes/introducer.php'));
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
     * Define the "Guarantor" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapGuarantorRoutes()
    {
        Route::prefix('guarantors')
            ->middleware(['web', 'user'])
            ->namespace($this->namespace.'\Guarantor')
            ->group(base_path('routes/guarantor.php'));
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

    /**
     * Define the "Investment" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::prefix('admin/rouzz')
            ->middleware(['web', 'admin'])
            ->namespace($this->namespace.'\Admin')
            ->group(base_path('routes/admin.php'));
    }
}
