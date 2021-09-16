<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $search ='';

    protected $queryString = ['search' => ['except' => ''],];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('name','like','%'. $this->search .'%')->with('images','subcategory.category')->paginate(6);

        return view('livewire.admin.show-products', compact('products'))->layout('layouts.admin');
    }
}
