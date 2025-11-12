<?php
namespace App\Modules\Domains\Authentication;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthenticateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerRoutes();
    }

    private function registerRoutes(): void
    {
        $path = __DIR__ . '/routes/api.php';

        if (file_exists($path)) {
            Route::middleware('api')
                ->prefix('api/auth')
                ->group($path);
        }
    }

}
