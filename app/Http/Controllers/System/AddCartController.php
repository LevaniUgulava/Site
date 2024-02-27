<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repository\AddCartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddCartController extends Controller
{


    public function index(AddCartRepository $AddCartRepository)
    {
        $data = $AddCartRepository->index();
        return view('Products.AddCart', compact('data'));
    }


    public function add($product)
    {
        $name = Product::where('id', $product)->first();
        $id = $product;
        $user = Auth::user();

        $user->productss()->attach($id);
        return redirect()->back()->with('message', 'You Added ' . $name->name . ' to Cart!');
    }

    public function delete($product)
    {
        $name = Product::where('id', $product)->first();
        $id = $product;
        $user = Auth::user();

        $user->productss()->detach($id);
        return redirect()->back()->with('message', 'You Delete ' . $name->name . ' to Cart!');
    }

    public function Increment($productid)
    {
        $user = Auth::user();
        $i = $user->productss()->find($productid)->pivot->quantity;
        $increment = $i + 1;

        $user->productss()->updateExistingPivot($productid, ['quantity' => $increment]);
        return redirect()->back();
    }


    public function Decrement($productid)
    {
        $user = Auth::user();
        $i = $user->productss()->find($productid)->pivot->quantity;
        $decrement = $i - 1;
        $user->productss()->updateExistingPivot($productid, ['quantity' => $decrement]);
        return redirect()->back();
    }
}
