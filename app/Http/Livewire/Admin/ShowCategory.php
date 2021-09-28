<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;


class ShowCategory extends Component
{
  public $category;
  public $subcategories;
  public $subcategory;
  public $open_confir = false;

  protected $rules = [
    'createForm.name' => 'required',
    'createForm.slug' => 'required|unique:subcategories,slug',
    'createForm.color' => 'required',
    'createForm.size' => 'required',
  ];

  protected $validationAttributes = [
    //create
    'createForm.name' => 'nombre',
    'createForm.slug' => 'slug',
    'createForm.color' => 'color',
    'createForm.size' => 'medida',

    //edit
    'editForm.name' => 'nombre',
    'editForm.slug' => 'slug',
    'editForm.color' => 'color',
    'editForm.size' => 'medida',
  ];
  public $createForm = [
    'name' => null,
    'slug' => null,
    'color' => false,
    'size' => false,
  ];
  public $editForm = [
    'name' => null,
    'slug' => null,
    'color' => false,
    'size' => false,
    'open' => false,
  ];

  public function confirsubcategorytDelete(Subcategory $subcategory)
  {
    $this->subcategory = $subcategory;
    $this->open_confir = true;
  }
  public function delete()
  {

    $mensaje = "La subcategoría " . $this->subcategory->name . " fue eliminada satisfactoriamente";

    $this->open_confir = false;

    $this->subcategory->delete();

    $this->getSubcategories();

    session()->flash('flash.banner', $mensaje);
    session()->flash('flash.bannerStyle', 'danger');
  }


  public function mount(Category $category)
  {
    $this->category = $category;
    $this->getSubcategories();
  }
  public function getSubcategories()
  {
    $this->subcategories = Subcategory::where('category_id', $this->category->id)->get();
  }

  public function updatedCreateFormName($value)
  {
    $this->createForm['slug'] = Str::slug($value);
  }
  public function updatedEditFormName($value)
  {
    $this->editForm['slug'] = Str::slug($value);
  }

  public function edit(Subcategory $subcategory)
  {
    $this->resetValidation();
    $this->subcategory = $subcategory;

    $this->editForm['name'] = $subcategory->name;
    $this->editForm['slug'] = $subcategory->slug;
    $this->editForm['color'] = $subcategory->color;
    $this->editForm['size'] = $subcategory->size;
    $this->editForm['open'] = true;
  }
  public function update()
  {
    $this->validate([
      'editForm.name' => 'required',
      'editForm.slug' => 'required|unique:subcategories,slug,' . $this->subcategory->id,
      'editForm.color' => 'required',
      'editForm.size' => 'required',
    ]);

    $this->subcategory->update($this->editForm);
    $this->reset('editForm');
    $this->getSubcategories();
  }

  public function save()
  {
    $this->validate();

    $this->category->subcategories()->create($this->createForm);

    $this->reset('createForm');

    $this->getSubcategories();
  }
  public function render()
  {
    return view('livewire.admin.show-category')->layout('layouts.admin');
  }
}
