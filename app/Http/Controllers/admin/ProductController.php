<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function files(Product $product, Request $request)
    {
        $request->validate([
            'file' => ['image','mimes:png,jpg','max:2048','required']
        ]);

       $url = Storage::put('products', $request->file('file'));

        $product->images()->create([
            'url' => $url
        ]);
    }
}
