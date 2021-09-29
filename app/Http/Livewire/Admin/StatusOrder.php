<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusOrder extends Component
{
    public $order;
    public $status;

    public function mount()
    {
        $this->status = $this->order->status;
    }

    public function update()
    {
        $this->order->status =  $this->status;
        $this->order->update();
    }

    public function render()
    {
        $items = json_decode($this->order->content);

        return view('livewire.admin.status-order',compact('items'));
    }
}
