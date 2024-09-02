<?php

namespace App\Providers;

use App\Repositories\EloquentEpisodiosRepository;
use App\Repositories\EpisodiosRepository;
use App\Repositories\SeriesRepository;
use App\Repositories\EloquentSeriesRepository;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{

    public array $bindings=[
        SeriesRepository::class=>EloquentSeriesRepository::class,
        EpisodiosRepository::class=>EloquentEpisodiosRepository::class,
    ];

    /*
    public function register(): void
    {
        $this->app->bind(SeriesRepository::class,EloquentSeriesRepository::class);
    }
    public function boot(): void
    {
        //
    }*/
}
