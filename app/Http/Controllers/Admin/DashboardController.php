<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\Language\app\Models\Language;
use Modules\Order\app\Models\Order;
use Modules\Product\app\Services\ProductService;

class DashboardController extends Controller
{
    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->middleware('auth:admin');
        $this->productService = $productService;
    }
    public function dashboard()
    {
        $products = $this->productService->getProducts()->count();

        $totalOrders = Order::where('order_status', '!=', 'pending')->orWhere('order_status', '!=', 'rejected')->orWhere('order_status', '!=', 'cancelled')->count();

        // total customers
        $totalCustomers = Order::select('user_id')->groupBy('user_id')->get()->count();

        // total incomes
        $totalIncomes = Order::where('payment_status', 'success')->sum('total_amount');
        // last 30 days orders
        $last30DaysOrders = Order::where('order_status', '!=', 'pending')->orWhere('order_status', '!=', 'rejected')->orWhere('order_status', '!=', 'cancelled')->where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->count();
        // today's orders
        $data['todaysOrders'] = Order::where('order_status', '!=', 'rejected')->where('order_status', '!=', 'cancelled')->whereDate('created_at', \Carbon\Carbon::today())->count();

        $data['recentOrders'] = Order::orderBy('id', 'desc')->take(5)->get();
        $data['latestCustomers'] = User::orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('products', 'totalOrders', 'totalCustomers', 'totalIncomes', 'last30DaysOrders', 'data'));
    }

    public function setLanguage()
    {
        $lang = Language::whereCode(request('code'))->first();

        if (session()->has('lang')) {
            session()->forget('lang');
            session()->forget('text_direction');
        }
        if ($lang) {
            session()->put('lang', $lang->code);
            session()->put('text_direction', $lang->direction);

            $notification = __('Language Changed Successfully');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];

            return redirect()->back()->with($notification);
        }

        session()->put('lang', config('app.locale'));

        $notification = __('Language Changed Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
}
