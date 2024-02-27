<?php

namespace App\Repository;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

interface ProductRepositoryInterface
{

    public function store(ProductRequest $request);

    public function update(Request $request, $id);
}
