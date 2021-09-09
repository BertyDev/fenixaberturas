<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;
    public $search;

    public $open = false;

    public function updatedSearch($value)
    {
        if ($value) {
            $this->open = true;
        } else {
            $this->open = false;
        }
    }

    public function render()
    {
        if ($this->search) {
            $products = Product::with(['images','subcategory.category'])->where('name', 'LIKE', '%' . $this->search . '%')
            ->where('status',2)
            ->paginate(8)
            ;
        } else {
            $products = [];
        }


        return view('livewire.search', compact('products'));
    }
}
