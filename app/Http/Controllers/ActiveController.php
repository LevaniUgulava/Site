<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    public function private($id)
    {
        $product = Product::findorfail($id);
        $product->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }

    public function unprivate($id)
    {
        $product = Product::findorfail($id);
        $product->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }
}
