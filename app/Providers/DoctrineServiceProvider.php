<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Doctrine\CarbonType;

class DoctrineServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Doctrine\DBAL\Types\Type::overrideType('datetime', CarbonType::class);
    }
}
