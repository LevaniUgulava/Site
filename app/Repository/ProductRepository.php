<?php

namespace App\Repository;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductRepositoryInterface
{

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
        ]);

        if ($request->hasfile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                $imagename = date('now') . $image->getclientoriginalname();
                $path = public_path() . '/image';
                $image->move($path, $imagename);
                $product->images()->create([
                    'images' => $imagename,
                    'product_id' => $product->id,
                ]);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findorfail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,

        ]);

        if ($request->hasfile('image')) {
            if ($product->images->isnotempty()) {
                foreach ($product->images as $image) {
                    $pathh = public_path() . '/image/' . $image->images;
                    unlink($pathh);
                    $image->delete();
                }
            }
            $images = $request->file('image');
            foreach ($images as $image) {
                $imagename = date('now') . $image->getclientoriginalname();
                $path = public_path() . '/image';
                $image->move($path, $imagename);
                $product->images()->create([
                    'images' => $imagename,
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
