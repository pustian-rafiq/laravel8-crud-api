<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
        ],200);
    }
}
