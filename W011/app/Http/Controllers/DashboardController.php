<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Sale::sum('total_amount');
        $totalOrders = Sale::count();
        $totalItems = Sale::sum('quantity');

        $monthlySales = Sale::select(
                DB::raw("DATE_FORMAT(sale_date, '%Y-%m') as month"),
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $categorySales = Sale::join('products', 'sales.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(sales.total_amount) as total'))
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total')
            ->get();

        $topProducts = Sale::join('products', 'sales.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sales.quantity) as quantity'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('quantity')
            ->limit(10)
            ->get();

        $recentSales = Sale::with('product')->latest('sale_date')->latest('id')->limit(12)->get();

        return view('dashboard', compact(
            'totalSales', 'totalOrders', 'totalItems',
            'monthlySales', 'categorySales', 'topProducts', 'recentSales'
        ));
    }
}
