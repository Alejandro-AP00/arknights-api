<?php

namespace App\Providers;

use App\Enums\Locales;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filesystem::macro('gameData', function (Locales $locale, string $path) {
             $data = match ($locale) {
                Locales::Chinese => $this->get(public_path('ArknightsGameData/'.$locale->value.'/gamedata/excel/'.$path)),
                default => $this->get(public_path('ArknightsGameData_Yostar/'.$locale->value.'/gamedata/excel/'.$path)),
            };

             return json_decode($data, true);
        });
    }
}
