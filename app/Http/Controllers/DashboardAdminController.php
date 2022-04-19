<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $year = date('y');
        $allSales = Sale::whereYear('created_at', $year)
                        ->orderBy('created_at', 'desc')
                        ->get();
        $products = Product::orderBy('created_at', 'desc')->get();
        $users = User::whereYear('created_at', $year)->get();

        $pointsProduct = [];


        foreach ($products as $product) {
            $pointsProduct[] = ['name' => $product['name'], 'y'=>$product['stock']];
        }

        return view('graphics')->with(['pointsProduct' => json_encode($pointsProduct)]);
    }
}
