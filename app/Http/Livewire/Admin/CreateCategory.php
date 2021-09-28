<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateCategory extends Component
{
    use WithFileUploads;

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:categories,slug',
        'createForm.icon' => 'required',
        'createForm.brands' => 'required',
        'createForm.image' => 'required|image|max:1024|mimes:png,jpg',
    ];
    protected $validationAttributes = [
        //create
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
        'createForm.icon' => 'icono',
        'createForm.brands' => 'marcas',
        'createForm.image' => 'imagen',
        //edit
        'editForm.name' => 'nombre',
        'editForm.slug' => 'slug',
        'editForm.icon' => 'icono',
        'editForm.brands' => 'marcas',
        'editImage' => 'imagen',
    ];

    public $rand;
    public $categories;
    public $category;
    public $editImage;
    public $brands;
    public $open_confir = false;

    public $createForm = [
        'name' => null,
        'slug' => null,
        'icon' => null,
        'brands' => [],
        'image' => null,
    ];
    public $editForm = [
        'open' => false,
        'name' => null,
        'slug' => null,
        'icon' => null,
        'brands' => [],
        'image' => null,
    ];

    public function edit(Category $category)
    {

        $this->reset(['editImage']);
        $this->resetValidation();
        $this->category = $category;

        $this->editForm['name'] = $category->name;
        $this->editForm['slug'] = $category->slug;
        $this->editForm['icon'] = $category->icon;
        $this->editForm['brands'] = $category->brands->pluck('id');
        $this->editForm['image'] = $category->image;
        $this->editForm['open'] = true;
    }

    public function confirCategorytDelete(Category $category)
    {
        $this->category = $category;
        $this->open_confir = true;
    }
    public function delete()
    {

        $mensaje = "La Categoría " . $this->category->name . " fue eliminada satisfactoriamente";

        $this->open_confir = false;
        Storage::delete($this->category->image);
        $this->category->delete();

        $this->getCategories();

        session()->flash('flash.banner', $mensaje);
        session()->flash('flash.bannerStyle', 'danger');
        redirect()->route('admin.categories.index');
    }
    public function update()
    {
        $brands = $this->editForm['brands'];
        //delete element in array by value false
        if (($key = array_search(false, $brands)) !== false) {
            unset($brands[$key]);
        }
        $this->editForm['brands'] = $brands;
        $rules = [
            'editForm.name' => 'required',
            'editForm.slug' => 'required|unique:categories,slug,' . $this->category->id,
            'editForm.icon' => 'required',
            'editForm.brands' => 'required',
        ];
        if ($this->editImage) {
            $rules['editImage'] =  'image|max:1024|mimes:png,jpg';
        }
        $this->validate($rules);
        if ($this->editImage) {
            Storage::delete($this->editForm['image']);
            $this->editForm['image'] = $this->editImage->store('categories');
        }
        $this->category->update($this->editForm);

        $this->category->brands()->sync($this->editForm['brands']);

        $this->reset(['editForm', 'editImage']);

        $this->getCategories();
    }


    public function mount()
    {
        $this->getCategories();
        $this->getBrands();
        $this->rand = rand();
    }

    public function updatedCreateFormName($value)
    {
        $this->createForm['slug'] = Str::slug($value);
    }

    public function updatedEditFormName($value)
    {
        $this->editForm['slug'] = Str::slug($value);
    }

    public function getCategories()
    {
        $this->categories = Category::all();
    }
    public function getBrands()
    {
        $this->brands = Brand::all();
    }
    public function save()
    {
        $brands = $this->createForm['brands'];
        //delete element in array by value false
        if (($key = array_search(false, $brands)) !== false) {
            unset($brands[$key]);
        }
        $this->createForm['brands'] = $brands;

        $this->validate();
        $image = $this->createForm['image']->store('categories');

        $category = Category::create([
            'name' => $this->createForm['name'],
            'slug' => $this->createForm['slug'],
            'icon' => $this->createForm['icon'],
            'image' => $image,
        ]);

        $category->brands()->attach($this->createForm['brands']);

        $this->rand = rand();
        $this->reset('createForm');

        $this->getCategories();
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.admin.create-category');
    }
}
