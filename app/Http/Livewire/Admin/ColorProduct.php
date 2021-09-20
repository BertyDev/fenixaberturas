<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;
use App\Models\ColorProduct as Pivot;

class ColorProduct extends Component
{

    public $product, $colors, $color_id, $quantity, $open = false, $open_confir = false;

    public $pivot, $pivot_color_id, $pivot_quantity;

    protected $rules = [
        'color_id' => 'required',
        'quantity' => 'required|numeric'
    ];

    public function mount()
    {
        $this->colors = Color::all();
    }

    public function edit(Pivot $pivot)
    {
        $this->pivot = $pivot;
        $this->pivot_color_id = $pivot->color_id;
        $this->pivot_quantity = $pivot->quantity;

        $this->open = true;
    }

    public function confirUserDelete(Pivot $pivot)
    {
        $this->pivot = $pivot;
        $this->open_confir = true;
    }
    public function delete()
    {
        $this->pivot->delete();
        $this->product = $this->product->fresh();
        $this->open_confir = false;
    }

    public function update()
    {
        $this->pivot->color_id = $this->pivot_color_id;
        $this->pivot->quantity = $this->pivot_quantity;

        $this->pivot->update();

        $this->product = $this->product->fresh();
        $this->open = false;
    }

    public function save()
    {
        $this->validate();

        $this->product->colors()->attach([
            $this->color_id => ['quantity' => $this->quantity]
        ]);

        $this->reset('color_id', 'quantity');

        $this->emit('saved');

        $this->product = $this->product->fresh();
    }

    public function render()
    {
        $product_colors = $this->product->colors;

        return view('livewire.admin.color-product', compact('product_colors'));
    }
}
