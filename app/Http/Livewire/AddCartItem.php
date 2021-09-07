<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItem extends Component
{
    public  $qty= 1;

    public $product,$quantity = 0;

    public $options = [
        'size_id' => null,
        'color_id' => null,
    ];

    public function mount(){
        $this->quantity = qty_available($this->product->id);
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function decrement()
    {
            $this->qty = $this->qty -1;
        
    }
    public function increment()
    {
        $this->qty = $this->qty +1;
    }

    public function addItem()
    {
        Cart::add([
          'id' => $this->product->id,
          'name' => $this->product->name,
          'qty' => $this->qty, 
          'price' => $this->product->price, 
          'weight' => 550, 
          'options' => $this->options,
        ]);
        $this->quantity = qty_available($this->product->id);

        $this->reset('qty');
        
        $this->emitTo('dropdown-cart','render');
    }


    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
