<?php

namespace App\Http\Controllers;

use App\Models\orderDetail;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $todays_order = orderDetail::whereDate('created_at', Carbon::today())->count();
        $last_weekl_orders = orderDetail::whereDate('created_at', ">=", Carbon::today()->subDays(7))->count();
        $total_sell = order::whereMonth('created_at', Carbon::today()->subMonth()->format('m'))->sum('total_price');
        $total_product_sell = orderDetail::whereMonth('created_at', Carbon::today()->subMonth()->format('m'))->sum('quantity');
        $yesterday_total_sale = order::whereDate('created_at', Carbon::yesterday())->sum('total_price');
        $today_total_sale = order::whereDate('created_at', Carbon::today())->sum('total_price');
        return view('home',[
            'todays_order' => $todays_order,
            'last_weekl_orders' => $last_weekl_orders,
            'total_product_sell' => $total_product_sell,
            'total_sell' => $total_sell,
            'yesterday_total_sale' => $yesterday_total_sale,
            'today_total_sale' => $today_total_sale,
        ]);
    }

    function welcome()
    {
        return view('welcome');
    }
}
