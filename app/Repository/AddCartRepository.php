<?php

namespace App\Repository;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class AddCartRepository
{

    public function index()
    {
        $users = User::with('products')
            ->whereHas('productss', function ($query) {
                return $query->where('user_product.user_id', Auth::user()->id);
            })
            ->get();
        $totalQuantity = 0;
        $total = 0;
        foreach ($users as $user) {
            foreach ($user->productss as $product) {
                if ($product->pivot->quantity >= 1) {
                    $totalQuantity += $product->pivot->quantity;
                    $price = $product->pivot->quantity * $product->price;
                    $total += $price;
                }
            }
        }


        return [
            'users' => $users,
            'totalQuantity' => $totalQuantity,
            'total' => $total,
        ];
    }
}
