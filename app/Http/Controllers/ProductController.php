<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //fetch all products
    public function getProducts(){
        $products = Product::latest()->get();

        return response()->json([
            "products" => $products
        ],200);
    }

    //fetch single product
    public function getProduct($id){
        $product = Product::find($id);

        if($product){
            return response()->json([
                "product" => $product
            ],200);
        }else{
            return response()->json([
                "message" => "No product found"
            ],404);
        }
       
    }

    //store product
    public function store(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:200',
            'desc' => 'required|max:200',
            'price' => 'required|max:200',
            'qty' => 'required|max:200',
        ]);

        $data = new Product();

        $data->name  = $request->name;
        $data->desc  = $request->desc;
        $data->price = $request->price;
        $data->qty   = $request->qty;

        $data->save();

        return response()->json([
            'message' => "Product inserted successfully"
        ],201);
    }

    //store update
    public function update(Request $request,$id){

        $validateData = $request->validate([
            'name' => 'required|max:200',
            'desc' => 'required|max:200',
            'price' => 'required|max:200',
            'qty' => 'required|max:200',
        ]);

        $data = Product::find($id);

        if($data){
            $data->name  = $request->name;
            $data->desc  = $request->desc;
            $data->price = $request->price;
            $data->qty   = $request->qty;
    
            $data->save();
    
            return response()->json([
                'message' => "Product updated successfully"
            ],200);
        }else{
            return response()->json([
                'message' => "Product not fund"
            ],404);
        }
       
    }
}
