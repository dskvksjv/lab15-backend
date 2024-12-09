<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapApiRoutes();  // Перевірте, що цей метод викликається
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')  // Маршрути мають починатися з /api
            ->middleware('api')  // Використовуємо middleware для API
            ->namespace('App\Http\Controllers\Api')  // Простір імен для контролерів
            ->group(base_path('routes/api.php'));  // Шлях до файлу маршрутів
    }
}
