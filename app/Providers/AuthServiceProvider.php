<?php

namespace App\Providers;

use App\Buyer;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Buyer::class => BuyerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::enableImplicitGrant();
        
        Passport::tokensCan([
            'purchase-product' => 'Create a new transaction for a specific product',
            'manage-product' => 'Cretae, read, update, delete products (CRUD)',
            'manage-accout' => 'Read your accout data, id, name =, email, if verified, 
                and if admin (cannot read password). Modify your data (email and password).
                Cannot delete your accout',
            'read-general' => 'Read general information like purchasing categories, purchased products,
                selling products, selling categories, your transaction (purchases and sales)',
        ]);
    }
}
