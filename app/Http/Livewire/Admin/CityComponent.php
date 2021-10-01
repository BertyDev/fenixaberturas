<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\District;
use Livewire\Component;

class CityComponent extends Component
{
    public $city;
    public $district;
    public $districts;
    public $open_confir = false;

    public $createForm = [
        'name' => '',
        
    ];
    public $editForm = [
        'name' => '',
        'open' => false,
    ];

    protected $validationAttributes = [
        //create
        'createForm.name' => 'nombre',
        //edit
        'editForm.name' => 'nombre',
    ];

    public function getDistricts()
    {
        $this->districts = District::where('city_id', $this->city->id)->get();
    }
    public function mount(City $city)
    {
        $this->city= $city;
        $this->getDistricts();
    }
    public function save()
    {
        $this->validate([
            'createForm.name' => 'required',
        ]);
        $this->city->districts()->create($this->createForm);
        $this->reset('createForm');
        $this->getDistricts();
        $this->emit('saved');
    }

    public function edit(District $district)
    {
        $this->resetValidation();
        $this->district = $district;
        $this->editForm['name'] = $district->name;
        $this->editForm['open'] = true;
    }

    public function update()
    {
        $this->validate([
            'editForm.name' => 'required',
        ]);
        $this->district->name = $this->editForm['name'];
        $this->district->update();
        $this->reset('editForm');
        $this->getDistricts();
    }
    public function confirdistrictDelete(District $district)
    {
        $this->district = $district;
        $this->open_confir = true;
    }
    public function delete()
    {
        $this->open_confir = false;
        $this->district->delete();
        $this->getDistricts();
    }
    public function render()
    {
        return view('livewire.admin.city-component')->layout('layouts.admin');
    }
}
