<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandComponent extends Component
{
    use WithPagination;

    public $brand;
    public $open_confir = false;

    public $createForm = [
        'name' => null,
    ];
    public $editForm = [
        'name' => null,
        'open' => false,
    ];

    public $rules = [
        'createForm.name' => 'required'
    ];

    protected $validationAttributes = [
        //create
        'createForm.name' => 'nombre',
        //edit
        'editForm.name' => 'nombre',
    ];

    public function save()
    {
        $this->validate();
        Brand::create($this->createForm);
        $this->reset('createForm');
    }

    public function edit(Brand $brand)
    {
        $this->brand = $brand;
        $this->editForm['name'] = $brand->name;
        $this->editForm['open'] = true;
    }
    public function update()
    {
        $this->validate([
            'editForm.name' => 'required'
        ]);
        $this->brand->update($this->editForm);
        $this->reset('editForm');
       
    }

    public function confirBrandDelete()
    {
        $this->open_confir = true;
    }

    public function delete(Brand $brand)
    {
        $brand->delete();
        $this->open_confir = false;
    }

    public function render()
    {
        $brands = Brand::paginate(8);
        return view(
            'livewire.admin.brand-component', compact('brands')
        )->layout('layouts.admin');
    }
}
