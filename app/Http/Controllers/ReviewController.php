<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {

        $request->validate([
            'coment' => 'required|min:5',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $product->reviews()->create([
            'coment' => $request->coment,
            'rating' => $request->rating,
            'user_id' => auth()->id(),
        ]);

        session()->flash('flash.banner', 'Tu reseña fue creada correctamente');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->back();
    }

}
