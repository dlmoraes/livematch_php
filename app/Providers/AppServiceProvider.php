<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\DAO\EmpresaRepositoryInterface',
            'App\Repositories\Eloquent\EmpresaRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\CategoriaRepositoryInterface',
            'App\Repositories\Eloquent\CategoriaRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\AnoRepositoryInterface',
            'App\Repositories\Eloquent\AnoRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\DistritalRepositoryInterface',
            'App\Repositories\Eloquent\DistritalRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\MesRepositoryInterface',
            'App\Repositories\Eloquent\MesRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\AnoMesRepositoryInterface',
            'App\Repositories\Eloquent\AnoMesRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\RegionalRepositoryInterface',
            'App\Repositories\Eloquent\RegionalRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\TipoIndRepositoryInterface',
            'App\Repositories\Eloquent\TipoIndRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\IndicadorRepositoryInterface',
            'App\Repositories\Eloquent\IndicadorRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\MetaRepositoryInterface',
            'App\Repositories\Eloquent\MetaRepository'
        );

        $this->app->bind(
            'App\Repositories\DAO\LancamentoRepositoryInterface',
            'App\Repositories\Eloquent\LancamentoRepository'
        );
    }
}
