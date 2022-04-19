<?php

namespace App\Http\Livewire\Shop;

use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    //Buscador
    public $search = "";

    public $selectCategory = null;

    public function render()
    {
        if ($this->selectCategory == null) {
            $products = Product::where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('categories', function($q){
                        $q->where('name', 'LIKE', '%' . $this->search . '%');
                    })
                    ->inRandomOrder()
                    ->paginate(8);
        } else {
            $products = Product::WhereHas('categories', function($q){
                        $q->where('name', 'LIKE', $this->selectCategory);
                    })
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->inRandomOrder()
                    ->paginate(8);
        }

        $categories = Category::pluck('name', 'id')->toArray();
        return view('livewire.shop.products')->with(['products' => $products, 'categories' => $categories]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectCategory()
    {
        $this->resetPage();
    }

}
