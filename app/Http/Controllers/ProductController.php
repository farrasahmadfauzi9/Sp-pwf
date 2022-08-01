<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //panggil validator untuk memvalidasi inputan
use App\Models\Product; //panggil model Product.php

class ProductController extends Controller
{
    //menambahkan data ke database
    public function store(Request $request) {
        //memvalidasi inputan
        $validator = validator::make($request->all(),[
            'product_name'=>'required|max:50',
            'product_type'=>'required|in:snack,drink,fruit,drug,groceries,cigarette,make-up,cigarette',
            'product_price'=>'required|numeric',
            'expired_at'=>'required|date'
    
        ]);
    
        //kondisi apabila inputan yang diinputkan tidak sesuai
        if($validator-> fails()) {
            //response json akan dikirim jika ada inputan yang salah
            return response()->json($validator->messages())->setStatusCode(422);
        }
        
        $spayload = $validator->validated();
        //masukan inputan yang benar ke database (table product)
        Product::create([
            'product_name' => $spayload['product_name'],
            'product_type' => $spayload['product_type'],
            'product_price' => $spayload['product_price'],
            'expired_at' => $spayload['expired_at']
        ]);
        //response json akan dikirim jika inputan benar
        return response()->json([
            'msg' => 'Data produk berhasil disimpan'
        ],201);
    }
}