<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepositoryImpl implements ProductRepository
{
    public function findAll()
    {
        return Product::where('slideActive', 0)
        ->limit(8)->get();
    }

    public function find($id)
    {
        return Product::find($id);
    }
}