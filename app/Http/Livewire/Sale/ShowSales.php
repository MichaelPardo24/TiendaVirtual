<?php

namespace App\Http\Livewire\Sale;

use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;

class ShowSales extends Component
{
    use WithPagination;

    public $dir = 'desc';
    public $sort = 'created_at';

    public $search = "";

    //Cargar la vista livewire si esta en true
    public $readyToUpload = false;

    public function render()
    {
        //si esta cargada la vista, se envian estos datos, si no no envia nada aun
        if ($this->readyToUpload) {
            $sales = Sale::orderBy($this->sort, $this->dir)
                    ->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('total', 'like', '%' . $this->search . '%')
                    ->orWhereHas('product', function($q){
                        $q->where('name', 'LIKE', '%' . $this->search . '%');
                    })
                    ->orWhereHas('product', function($q){
                        $q->where('price', 'LIKE', '%' . $this->search . '%');
                    })
                    ->orWhereHas('user', function($q){
                        $q->where('names', 'LIKE', '%' . $this->search . '%');
                    })
                    ->paginate(10);
        } else {
            $sales = [];
        }
        return view('livewire.sale.show-sales')->with(['sales' => $sales]);
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
    //Metodo que al recibir el llamado del div en la vista cambia la variable a true
    public function loadSales()
    {
        $this->readyToUpload = true;
    }
}
