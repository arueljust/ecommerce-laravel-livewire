<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{

    public function removeWishlistItem(int $wishlistId)
    {
        $wishlistRemove = Wishlist::where('user_id', auth()->user()->id)->where('id', $wishlistId)->first();
        if ($wishlistRemove) {
            $wishlistRemove->delete();

            $this->emit('wishlistAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Wishlist dihapus',
                'type' => 'success',
                'status' => 200
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Ada yang salah!',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlist' => $wishlist
        ]);
    }
}
