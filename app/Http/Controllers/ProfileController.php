<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Images;
use App\Models\Product;
use App\Repository\ProductRepositoryInterface;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images', 'user')->where('user_id', Auth::user()->id)->get();

        return view('Products.index', compact('products'));
    }

    public function all()
    {
        $products = Product::with('images', 'user')->where('user_id', '!=', Auth::user()->id)->where('active', 1)->get();
        return view('Products.all', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Products.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, ProductRepositoryInterface $productRepository)
    {
        $productRepository->store($request);
        return redirect()->back()->with('message', 'Added product');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('images')->findorfail($id);
        return view('Products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, ProductRepositoryInterface $productRepository)
    {
        $productRepository->update($request, $id);
        return redirect()->back()->with('message', 'Edited product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::with('images')->findorfail($id);
        $images = Images::where('product_id', $id)->get();

        if ($product->images->isnotempty()) {
            foreach ($product->images as $image) {
                $path = public_path() . '/image/' . $image->images;
                unlink($path);
            }
        }
        foreach ($images as $image) {
            $image->delete();
        }
        $product->delete();

        return redirect()->back()->with('message', 'You delete ' . $product->name);
    }
}
