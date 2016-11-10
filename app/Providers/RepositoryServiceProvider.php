<?php

namespace App\Providers;

use App\Entities\Company;
use App\Entities\Line;
use App\Entities\Occurrence;
use App\Entities\Status;
use App\Repositories\CompanyRepository;
use App\Repositories\LineRepository;
use App\Repositories\OccurrenceRepository;
use App\Repositories\StatusRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CompanyRepository::class, function ($app) {
            return new CompanyRepository($app['em'], $app['em']->getClassMetaData(Company::class));
        });

        $this->app->bind(LineRepository::class, function ($app) {
            return new LineRepository($app['em'], $app['em']->getClassMetaData(Line::class));
        });

        $this->app->bind(OccurrenceRepository::class, function ($app) {
            return new OccurrenceRepository($app['em'], $app['em']->getClassMetaData(Occurrence::class));
        });

        $this->app->bind(StatusRepository::class, function ($app) {
            return new StatusRepository($app['em'], $app['em']->getClassMetaData(Status::class));
        });
    }
}
