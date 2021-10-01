<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentOrder extends Component
{

    use AuthorizesRequests;
    public $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        $this->authorize('author',$this->order);
        $this->authorize('payment',$this->order);

        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);

        return view('livewire.payment-order', compact('items','envio'));
    }
}
