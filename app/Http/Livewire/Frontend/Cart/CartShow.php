<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart,$totalPrice=0,$quantityCount=1;

    public function incrementQuantity(int $cartId)
    {

        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();

        if ($cartData) {
            if ($cartData->product->quantity > $cartData->quantity) {
                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Kuantitas diubah',
                    'type' => 'success',
                    'status' => 200
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Tersisa ' . $cartData->product->quantity . ' item',
                    'type' => 'warning',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Ada yang salah!',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function decrementQuantity(int $cartId)
    {

        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
          
        if ($cartData->quantity > 1) {
            if ($cartData->product->quantity >= $cartData->quantity) {
                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Kuantitas diubah',
                    'type' => 'success',
                    'status' => 200
                ]);
          
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Ada yang Salah',
                    'type' => 'error',
                    'status' => 500
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Minimal pembelian 1 item',
                'type' => 'warning',
                'status' => 200
            ]);
        }
    
    }

    public function removeCartItem(int $cartId)
    {
        $cartRemove=Cart::where('user_id',auth()->user()->id)->where('id',$cartId)->first();
        if($cartRemove){
            $cartRemove->delete();

            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message',[
                'text'=>'Cart Dihapus',
                'type'=>'success',
                'status'=>200
            ]);
        }else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'Ada yang salah',
                'type'=>'error',
                'status'=>500
            ]);
        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
