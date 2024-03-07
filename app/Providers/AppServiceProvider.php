<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\GlobalSetting\app\Models\Setting;
use Cache, Session;
use Illuminate\Support\Facades\Auth;
use Modules\Currency\app\Models\MultiCurrency;

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

        try {

            $setting = Cache::rememberForever('setting', function () {

                $setting_info = Setting::get();

                $setting = array();
                foreach ($setting_info as $setting_item) {
                    $setting[$setting_item->key] = $setting_item->value;
                }

                $setting = (object)$setting;

                return $setting;
            });

            config(['broadcasting.connections.pusher.key' => $setting->pusher_app_key]);
            config(['broadcasting.connections.pusher.secret' => $setting->pusher_app_secret]);
            config(['broadcasting.connections.pusher.app_id' => $setting->pusher_app_id]);
            config(['broadcasting.connections.pusher.options.cluster' => $setting->pusher_app_cluster]);
            config(['broadcasting.connections.pusher.options.host' => 'api-' . $setting->pusher_app_cluster . '.pusher.com']);
        } catch (\Throwable $th) {
        }

        View::composer('*', function ($view) {

            $setting = Cache::get('setting');

            $view->with('setting', $setting);
        });

        View::composer('frontend.layouts.master', function ($view) {
            if (Auth::check()) {
                $cart_items = Cart::select('id', 'product_id', 'user_id', 'quantity')->where('user_id', Auth::id())->with('product:id,product_name,thumbnail_image_source,slug')->get();
            } else {
                $cart_items = [];
            }

            $view->with('cart_items', $cart_items);
        });

        /**
         * Register custom blade directives
         * this can be used for permission or permissions check
         * this check will be perform on admin guard
         */
        $this->registerBladeDirectives();
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('adminCan', function ($permission) {
            return "<?php if(auth()->guard('admin')->user()->can({$permission})): ?>";
        });

        Blade::directive('endadminCan', function () {
            return '<?php endif; ?>';
        });
    }
}
