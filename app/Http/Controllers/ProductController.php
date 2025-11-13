<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return response()->json(Product::all(),200);
    }

    public function show($id){
        $product = Product::find($id);
        if(!$product) return response()->json(['message'=>'Produk tidak ditemukan'],404);
        return response()->json($product,200);
    }

    public function store(Request $request){
        $request->validate([
            'nama_produk'=>'required|string|max:150',
            'deskripsi'=>'nullable|string',
            'stok'=>'required|integer',
            'harga_beli'=>'required|numeric',
            'harga_jual'=>'required|numeric',
        ]);

        $product = Product::create($request->only(['nama_produk','deskripsi','stok','harga_beli','harga_jual']));
        return response()->json($product,201);
    }

    public function update(Request $request,$id){
        $product = Product::find($id);
        if(!$product) return response()->json(['message'=>'Produk tidak ditemukan'],404);

        $request->validate([
            'nama_produk'=>'required|string|max:150',
            'deskripsi'=>'nullable|string',
            'stok'=>'required|integer',
            'harga_beli'=>'required|numeric',
            'harga_jual'=>'required|numeric',
        ]);

        $product->update($request->only(['nama_produk','deskripsi','stok','harga_beli','harga_jual']));
        return response()->json($product,200);
    }

    public function destroy($id){
        $product = Product::find($id);
        if(!$product) return response()->json(['message'=>'Produk tidak ditemukan'],404);

        $product->delete();
        return response()->json(['message'=>'Produk berhasil dihapus'],200);
    }
}
