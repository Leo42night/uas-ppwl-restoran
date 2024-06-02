<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrapFive();

        Blade::directive('convert', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });
        
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user = User::find(Auth::user()->id);
                View::share([
                    'userGlobal' => $user,
                    'userImage' => $user->getImageAsset(),
                ]);
            } else {
                $view->with(['userGlobal' => null]);
            }
        });
    }
}
