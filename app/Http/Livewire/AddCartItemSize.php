<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;

class AddCartItemSize extends Component
{
    public $product, $sizes, $color_id = "";

    public $size_id = "";

    public $qty = 1, $quantity = 0;

    public $colors = [];

    public function updatedSizeId($value)
    {
        $size = Size::find($value);

        $this->colors = $size->colors;
    }

    public function mount()
    {
        $this->sizes = $this->product->sizes;
    }
    public function updatedColorId($value)
    {
        if ($value != "") {
            $size = Size::find($this->size_id);
            $this->quantity = $size->colors->find($value)->pivot->quantity;
        } else {
            $this->quantity = 0;
            $this->qty = 1;
        }
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
