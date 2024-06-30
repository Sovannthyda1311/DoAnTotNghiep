<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {

        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSubcategories = Subcategory::count();
        $totalBrands = Brand::count();

        $totalUsers = User::where('role_as', '0')->count();

        $tadayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrders = Order::count();
        $todayOrder = Order::whereDate('created_at', $tadayDate)->count();
        $ThisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
        $ThisYearOrder = Order::whereYear('created_at', $thisYear)->count();

        return view('admin.dashboard', compact('totalProducts','totalCategories','totalSubcategories','totalBrands',
                                            'totalUsers','totalOrders','todayOrder','ThisMonthOrder','ThisMonthOrder',
                                        'ThisYearOrder'));
    }
}
