<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Department;
use Livewire\Component;

class ShowDepartment extends Component
{
    public $department;
    public $cities;
    public $city;
    public $open_confir = false;

    public $createForm = [
        'name' => '',
        'cost' => null,
    ];
    public $editForm = [
        'name' => '',
        'cost' => null,
        'open' => false,
    ];

    protected $validationAttributes = [
        //create
        'createForm.name' => 'nombre',
        'createForm.cost' => 'costo',
        //edit
        'editForm.name' => 'nombre',
        'editForm.cost' => 'costo'
    ];

    public function getCities()
    {
        $this->cities = City::where('department_id', $this->department->id)->get();
    }
    public function mount(Department $department)
    {
        $this->department = $department;
        $this->getCities();
    }
    public function save()
    {
        $this->validate([
            'createForm.name' => 'required',
            'createForm.cost' => 'required|numeric|min:0.01|max:3000.00',
        ]);
        $this->department->cities()->create($this->createForm);
        $this->reset('createForm');
        $this->getCities();
        $this->emit('saved');
    }

    public function edit(City $city)
    {
        $this->resetValidation();
        $this->city = $city;
        $this->editForm['name'] = $city->name;
        $this->editForm['cost'] = $city->cost;
        $this->editForm['open'] = true;
    }

    public function update()
    {
        $this->validate([
            'editForm.name' => 'required',
            'editForm.cost' => 'required|numeric|min:0.01|max:3000.00',
        ]);
        $this->city->name = $this->editForm['name'];
        $this->city->cost = $this->editForm['cost'];
        $this->city->update();
        $this->reset('editForm');
        $this->getCities();
    }
    public function confircityDelete(City $city)
    {
        $this->city = $city;
        $this->open_confir = true;
    }
    public function delete()
    {
        $this->open_confir = false;
        $this->city->delete();
        $this->getCities();
    }
    public function render()
    {
        return view('livewire.admin.show-department')->layout('layouts.admin');
    }
}
