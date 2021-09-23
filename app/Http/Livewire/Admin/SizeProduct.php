<?php

namespace App\Http\Livewire\Admin;

use App\Models\Size;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SizeProduct extends Component
{
    public $product;
    public $name;
    public $open = false;
    public $name_edit;
    public $size;
    public $open_confir;


    protected function rules()
    {
        return [
            'name' => ['required', 'max:50', Rule::unique('sizes', 'name')->where(function ($query) {
                return $query->where('product_id', $this->product->id);
            })]
        ];
    }
    public function update()
    {

        $this->validate([
            'name_edit' => ['required', 'max:50', Rule::unique('sizes', 'name')->where(function ($query) {
                return $query->where('product_id', $this->product->id);
            })->ignore($this->size->id, 'id')]
        ]);
        $this->size->name = $this->name_edit;
        $this->size->update();
        $this->product = $this->product->fresh();
        $this->open = false;
    }

    public function save()
    {
        $this->validate();
        $this->product->sizes()->create([
            'name' => $this->name,
        ]);
        $this->reset('name');
        $this->product = $this->product->fresh();
    }

    public function edit(Size $size)
    {
        $this->name_edit = $size->name;
        $this->size = $size;
        $this->open = true;
    }

    public function confirSizeDelete(Size $size)
    {
        $this->size = $size;
        $this->open_confir = true;
    }
    public function delete()
    {
        $this->size->delete();
        $this->product = $this->product->fresh();
        $this->open_confir = false;
    }

    public function render()
    {
        $sizes = $this->product->sizes;
        return view('livewire.admin.size-product', compact('sizes'));
    }
}
