<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($cartData) {
            $cartData->load('productColor', 'productSize'); // Load the associated product color and size

            if ($cartData->productColor && $cartData->productSize) {
                $maxQuantity = min($cartData->productColor->quantity, $cartData->productSize->quantity);
            } elseif ($cartData->productColor) {
                $maxQuantity = $cartData->productColor->quantity;
            } elseif ($cartData->productSize) {
                $maxQuantity = $cartData->productSize->quantity;
            } else {
                $maxQuantity = $cartData->product->quantity;
            }

            if ($cartData->quantity < $maxQuantity) {
                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Maximum quantity reached',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong!',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }


    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($cartData) {
            if ($cartData->quantity > 1) {
                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Minimum quantity reached',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong!',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function removeCartItem(int $cartId)
    {
        $cartRemoveData = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
        if ($cartRemoveData)
        {
            $cartRemoveData->delete();

            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart item removed',
                'type' => 'success',
                'status' => 200
            ]);
        }
        else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart item not found',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',[
            'cart' => $this->cart
        ]);
    }
}
