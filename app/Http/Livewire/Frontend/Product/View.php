<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $quantityCount = 1;

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {

                $this->dispatchBrowserEvent('message', [
                    'text' => 'Sudah ditambahkan',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Berhasil menambahkan',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {

            return redirect('login');
            // $this->dispatchBrowserEvent('message', [
            //     'text' => 'Please Login to continue',
            //     'type' => 'info',
            //     'status' => 401
            // ]);
            // return false;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 100) {
            $this->quantityCount++;
        }
    }

    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
                if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Sudah ditambahkan ke cart',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                } else {
                    if ($this->product->quantity >= 0) {
                        if ($this->product->quantity >= $this->quantityCount) {
                            // insert Product Cart
                            Cart::create([
                                'user_id' => auth()->user()->id,
                                'product_id' => $productId,
                                'quantity' => $this->quantityCount
                            ]);
                            $this->emit('CartAddedUpdated');
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Ditambahkan ke cart',
                                'type' => 'success',
                                'status' => 200
                            ]);
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Tersisa ' . $this->product->quantity . ' item',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Stok Habis',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product tidak ada',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {

            return redirect('login');
            // $this->dispatchBrowserEvent('message', [
            //     'text' => 'Please Login to add to cart',
            //     'type' => 'info',
            //     'status' => 401
            // ]);
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
