<?php

// app/Http/Livewire/Frontend/Product/WishlistHelper.php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

trait WishlistHelper
{
    public function addToWishList($productItem)
    {
        if (Auth::check()) {
            $wishlistExists = Wishlist::where('user_id', auth()->user()->id)
                ->where('product_id', $productItem)
                ->exists();

            if ($wishlistExists) {
                Wishlist::where('user_id', auth()->user()->id)
                    ->where('product_id', $productItem)
                    ->delete();
                $this->emit('wishlistAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist removed',
                    'type' => 'warning',
                    'status' => 409
                ]);
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productItem,
                ]);
                $this->emit('wishlistAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Add to wishlist successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please login to continue',
                'type' => 'error',
                'status' => 401
            ]);
            return false;
        }
    }
}

