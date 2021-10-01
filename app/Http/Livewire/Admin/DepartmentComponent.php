<?php

namespace App\Http\Livewire\Admin;

use App\Models\Department;
use Livewire\Component;

class DepartmentComponent extends Component
{
    public $department;
    public $departments;
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
        'editForm.name' => 'nombre'
    ];

    public function getDepartments()
    {
        $this->departments = Department::all();
    }

    public function mount()
    {
        $this->getDepartments();
    }

    public function save()
    {
        $this->validate([
            'createForm.name' => 'required'
        ]);
        Department::create($this->createForm);
        $this->reset('createForm');
        $this->emit('saved');
        $this->getDepartments();
    }

    public function edit(Department $department)
    {
        $this->resetValidation();
        $this->department = $department;
        $this->editForm['name'] = $department->name;
        $this->editForm['open'] = true;
    }

    public function update()
    {
        $this->validate([
            'editForm.name' => 'required'
        ]);
        $this->department->name = $this->editForm['name'];
        $this->department->update();
        $this->reset('editForm');
        $this->getDepartments();
    }
    public function confirdepartmentDelete()
    {
        $this->open_confir = true;
    }
    public function delete(Department $department)
    {
        $this->open_confir = false;
        $department->delete();
        $this->getDepartments();
    }


    public function render()
    {
        return view('livewire.admin.department-component')->layout('layouts.admin');
    }
}
