<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Str;

use Illuminate\Support\Facades;

class AdminProductController extends Controller
{
    public function index(){

        $product = Product::all();
        return view('admin.product', compact('product'));
    }

    //Método para mostrar a página editar produto 
    public function edit( Product $product){
        return view('admin.product_edit',[
            'product' => $product
        ]);
    }

    //Metodo para receber requisição e dar update - PUT
    public function update(Product $product, Request $request){
        
        $input = $request->validate([
            'name' => 'string|required',
            'price' => 'numeric|required',
            'stock' => 'numeric|required',
            'cover' => 'file|nullable',
            'description' => 'string|nullable',
        ]);

        $input['slug'] = Str::slug($input['name']);

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $path = $request->file('cover')->store('product','public'); 
            $input['cover'] = $path; 
        }

        $product->fill($input);

        $product->save(); 

        return \Redirect::route('admin.product');
    }

    //Metodo para criar um produto novo
    public function create(){
        return view('admin.product_create');
    }

    //Metodo para receber a requisição de criação de produto - POST
    public function store(Request $request){
        
        $input = $request->validate([
            'name' => 'string|required',
            'price' => 'numeric|required',
            'stock' => 'numeric|required',
            'cover' => 'file|nullable',
            'description' => 'string|nullable',
        ]);

        
        $input['slug'] = Str::slug($input['name']);
        
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $path = $request->file('cover')->store('product','public'); 
            $input['cover'] = $path; 
        }


        Product::create($input);

        return \Redirect::route('admin.product');

    }

    public function delete(Product $product){
        $product->delete();

        return \Redirect::route('admin.product');
    }

}
