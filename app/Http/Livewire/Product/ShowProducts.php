<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ShowProducts extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    
    //propiedades para crear un usuario
    public $name, $description, $price, $tax, $stock, $image, $identifier;
    public $selectedCategories = [];
    //Alerta que recibe si se crea, edita o elimina un usuario
    public $message = null;

    //Buscador
    public $search = "";

    //order
    public $sort = 'id';
    public $dir = 'desc';
    //Usuario a usar
    public $product;

    //Abrir modales de edicion y eliminacion
    public $open_create = false;
    public $open_edit = false;

    //Cargar la vista livewire si esta en true
    public $readyToUpload = false;

    //Reglas para editar al producto
    protected $rules = [
        'product.name' => 'required|max:80',
        'product.description' => 'required',
        'product.price' => 'required|integer|digits_between:1,11',
        'product.tax' => 'required|integer|max:100',
        'product.stock' => 'required|integer|digits_between:1,11',
        'image' => '',
        'product.status' => 'required'
    ];
    public function mount()
    {
        $this->product = new Product;
    }

    //Al recibir los datos en $search actualiza la pagina
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //Metodo que al recibir el llamado del div en la vista cambia la variable a true
    public function loadProducts()
    {
        $this->readyToUpload = true;
    }


    //Carga inicial del controlador
    public function render()
    {
        //si esta cargada la vista, se envian estos datos, si no no envia nada aun
        if ($this->readyToUpload) {
            $products = Product::Where('status', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orWhere('price', 'like', '%' . $this->search . '%')
            ->orWhere('tax', 'like', '%' . $this->search . '%')
            ->orWhere('stock', 'like', '%' . $this->search . '%')
            ->orWhere('id', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->dir)
            ->paginate(10);
        } else {
            $products = [];
        }

        $allCategories = Category::pluck('name', 'id')->toArray();

        return view('livewire.product.show-products')->with(['products' => $products, 'message' => $this->message, 'allCategories' => $allCategories]);
    }

    //metodo para organizar las columnas de las tablas
    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->dir == 'desc') {
                $this->dir = 'asc';
            } else{
                $this->dir = 'desc';
            }
        } else{
            $this->sort = $sort;
        }
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName, [
            'name' => 'required|max:80',
            'description' => 'required',
            'price' => 'required|integer|digits_between:1,11',
            'tax' => 'required|integer|max:100',
            'stock' => 'required|integer|digits_between:1,11',
            'image' => 'required',
            'selectedCategories' => 'required',
        ]);
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|max:80',
            'description' => 'required',
            'price' => 'required|integer|digits_between:1,11',
            'tax' => 'required|integer|max:100',
            'stock' => 'required|integer|digits_between:1,11',
            'image' => 'required',
            'selectedCategories' => 'required'
        ]);

        $image = $this->image->store('products');
        $this->identifier = rand();

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'tax' => $this->tax,
            'stock' => $this->stock,
            'image' => $image,
        ]);

        $newProductId = Product::latest()->first()->id;

        foreach ($this->selectedCategories as $selectedCategory) {
            CategoryProduct::create([
                'category_id' => $selectedCategory,
                'product_id' => $newProductId
            ]);
        }

        $this->message = 'El producto ' . $this->name . ' ha sido creado satisfactoriamente';
        $this->reset(['open_create', 'name', 'description', 'price', 'tax', 'stock', 'image', 'selectedCategories']);
    }






    //metodo que toma el parametro a nuestra variable $product y abre modal de edicion
    public function edit(Product $product)
    {
        $this->product = $product;
        $this->open_edit = true;
    }

    //Metodo que actualiza los datos del usuario obtenido y cierra el modal
    public function update()
    {
        $this->validate();
        if ($this->image) {
            Storage::delete([$this->product->image]);
            $this->product->image = $this->image->store('products');
        }
        $this->product->save();
        
        $this->reset(['open_edit', 'image']);
        
        $this->message = 'El producto ' . $this->product->name . ' ha sido actualizado satisfactoriamente';
        $this->identifier = rand();
    }

    public function closeAlert(){
        $this->message = Null;
    }
}
