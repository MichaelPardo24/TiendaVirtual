<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use App\Models\Product;

class MoreSaleProducts extends Component
{
    public function render()
    {
        $products = Product::latest()
        ->take(4)
        ->where('status', 'activo')
        ->get();
        return view('livewire.shop.more-sale-products')->with(['products' => $products]);
    }
}
