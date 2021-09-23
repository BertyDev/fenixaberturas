<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;
use App\Models\ColorSize as Pivot;

class ColorSize extends Component
{
    public $size;
    public $open_confir = false;
    public $pivot;
    public $colors;
    public $color_id;
    public $quantity;
    protected $rules = [
        'color_id' => 'required',
        'quantity' => 'required|numeric'
    ];

    public function mount()
    {
        $this->colors = Color::all();
    }
    public function save()
    {
        $this->validate();
        $this->size->colors()->sync([
            $this->color_id => ['quantity' => $this->quantity]
        ],false);

        $this->reset('color_id', 'quantity');

        $this->emit('saved');

        $this->size = $this->size->fresh();
    }
    public function confirColorDelete(Pivot $pivot)
    {
        $this->pivot = $pivot;
        $this->open_confir = true;
    }
    public function delete()
    {
        $this->pivot->delete();
        $this->size = $this->size->fresh();
        $this->open_confir = false;
    }

    public function render()
    {

        $size_colors = $this->size->colors;

        return view('livewire.admin.color-size', compact('size_colors'));
    }
}
