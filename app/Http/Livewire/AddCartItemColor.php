<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddCartItemColor extends Component
{
    public $product, $colors;
    public $color_id ="";

    public $qty = 1;
    public $quantity = 0;

    public function mount()
    {
        $this->colors = $this->product->colors;
    }

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }

    public function updatedColorId($value)
    {
        if ($value != "") {
            $this->quantity = $this->product->colors->find($value)->pivot->quantity;
        }else{
            $this->quantity = 0;
            $this->qty = 1;
        }
        
    }
    public function decrement()
    {
            $this->qty = $this->qty -1;
        
    }
    public function increment()
    {
        $this->qty = $this->qty +1;
    }
}
