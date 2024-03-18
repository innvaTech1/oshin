<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\GlobalSetting\app\Models\Setting;
// use Cache, Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

            // Handle cart items after user authentication
            Auth::authenticated(function ($user) {
                $cartItems = session()->get('cart', []);

                if (!empty($cartItems)) {
                    foreach ($cartItems as $productId => $item) {
                        $existingCartItem = Cart::where('user_id', $user->id)
                            ->where('product_id', $productId)
                            ->first();

                        if ($existingCartItem) {
                            $existingCartItem->quantity += $item['quantity'];
                            $existingCartItem->save();
                        } else {
                            $newCartItem = new Cart();
                            $newCartItem->user_id = $user->id;
                            $newCartItem->product_id = $productId;
                            $newCartItem->quantity = $item['quantity'];
                            $newCartItem->save();
                        }
                    }

                    session()->forget('cart');
                }
            });
        } catch (\Throwable $th) {
        }

        View::composer('*', function ($view) {

            $setting = Cache::get('setting');

            $view->with('setting', $setting);
        });

        View::composer('frontend.layouts.master', function ($view) {
            if (Auth::check()) {
                $cart_items = Cart::with('product:id,product_name,thumbnail_image_source,slug')
                    ->where('user_id', Auth::id())
                    ->select('id', 'product_id', 'user_id', 'quantity')
                    ->get();
            } else if (!Auth::check() && session()->has('cart')) {
                $cart_items = [];
                foreach (session()->get('cart') as $productID => $session_item) {
                    $product = Product::select('id', 'product_name', 'slug', 'thumbnail_image_source')
                        ->where('id', $productID)
                        ->first();
                    $cart_item_with_product = [
                        'quantity' => $session_item['quantity'],
                        'id' => $session_item['cart_id'],
                        'product' => [
                            'product_name' => $product->product_name,
                            'thumbnail_image_source' => $product->thumbnail_image_source,
                            'slug' => $product->slug,
                            'id' => $productID
                        ],
                    ];
                    $cart_items[] = $cart_item_with_product;
                }
            } else {
                $cart_items = [];
            }

            $view->with('cart_items', $cart_items);
        });

        View::composer('frontend.partials.header', function ($view) {
            $categories = Category::select('id','name','status')->where('status',true)->get();

            $view->with('categories', $categories);
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
