<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{

    public $cart, $totalProductAmount = 0;

    public $fullname, $nik, $Phone, $email, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'nik' => 'required|string|max:18|min:16',
            'Phone' => 'required|string|max:13|min:11',
            'email' => 'required|email|max:121',
            'pincode' => 'required|string|max:5|min:5',
            'address' => 'required|string|max:500',
        ];
    }


    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'ZTK-' . Str::random(10),
            'fullname' => $this->fullname,
            'nik' => $this->nik,
            'email' => $this->email,
            'Phone' => $this->Phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        foreach ($this->cart as $cartItem) {

            $orderItem = Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price,
            ]);

            if ($cartItem->product_id) {

                $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }
        }

        return $order;
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash On Delivery';

        $codOrder = $this->placeOrder();
        if ($codOrder) {

            session()->flash('message','Pesanan berhasil dan sedang diproses');
            // kosongkan cart jika checkout suksess
            Cart::where('user_id', auth()->user()->id)->delete();
            // hapus cart

            $this->dispatchBrowserEvent('message', [
                'text' => 'Order place success',
                'type' => 'success',
                'status' => 200
            ]);

            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function totalAmount()
    {
        $this->totalProductAmount = 0;
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->cart as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->totalProductAmount = $this->totalAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
