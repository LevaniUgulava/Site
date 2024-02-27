<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($id)
    {
        $user = auth()->user();
        $user->productslike()->attach($id);

        return redirect()->back();
    }

    public function unlike($id)
    {
        $user = auth()->user();
        $user->productslike()->detach($id);

        return redirect()->back();
    }
}
