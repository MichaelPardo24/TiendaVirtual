<?php

namespace App\Http\Controllers;

use App\Http\Requests\confirmPaymentRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Mail;


class ShopController extends Controller
{
    public $nameCategoryProductSelected;

    public function index(){
        return view('shop.products');
    }

    public function product(Product $product)
    {
        if (count($product->categories) > 2) {
            $this->nameCategoryProductSelected = $product->categories->first()->name;
            $similarProducts = Product::latest()
                                    ->take(4)
                                    ->WhereHas('categories', function($q){
                                        $q->where('name', $this->nameCategoryProductSelected);
                                    })
                                    ->get();
        } else {
            $similarProducts = Product::latest()
                                    ->take(4)
                                    ->where('id', '!=', $product->id)
                                    ->get();
        }
        return view('shop.product')->with(['product' => $product, 'similarProducts' => $similarProducts]);
    }

    public function checkout(Product $product)
    {
        if ($product->stock == 0 || $product->status == 'inactivo'){
            return redirect("producto/$product->id");
        } else {
            return view('shop.checkout')->with(['product'=>$product]);
        }
    }

    public function confirmPayment(confirmPaymentRequest $request, Product $product){

        $product->stock = $product->stock-1;
        $product->save();

        Sale::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'total' => ($product->price * $product->tax / 100) + $product->price
            ]);


        $sale = Sale::latest()->first();
        $sale->dateFormat = $sale->created_at->format('d-m-Y');
        $data= $sale->toArray();
        $data['subtotal'] = $product->price;
        $data['nameProduct'] = $product->name;
        $data['tax'] = $product->price * $product->tax / 100;
        $data['nameUser'] = auth()->user()->names;
        $data['email'] = auth()->user()->email;

        $pdf = PDF::loadView('shop.mail', $data);
         
        Mail::send('shop.mail', $data, function ($message) use ($data, $pdf) {
            $message->to($data['email'])
                ->subject('Gracias por tu compra '.$data['nameUser'])
                ->attachData($pdf->output(), "factura_electronica.pdf");
        });
        return redirect('mis-compras');
    }

    public function shoppingHistory()
    {
        $sales = Sale::latest()->where('user_id', '=', auth()->user()->id)->get();
        return view('shop.shoppingHistory')->with(['sales'=>$sales]);
    }

}