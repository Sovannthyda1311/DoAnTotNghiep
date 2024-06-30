<?php

namespace App\Http\Livewire\Frontend\Page;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Frontend\Product\WishlistHelper;

class ProductDetail extends Component
{
    public  $product, $prodColorSelectedQuantity, $quantityCount = 1, $productColorId, $productSizeId, $prodSizeSelectedQuantity;

    use WishlistHelper;


     public function colorSelected($productColorId)
     {
         $this->productColorId = $productColorId;
         $productColor = $this->product->productColors()->where('id',$productColorId)->first();
         $this->prodColorSelectedQuantity = $productColor->quantity;

         if($this->prodColorSelectedQuantity == 0){
             $this->prodColorSelectedQuantity = 'outofstock';
         }
     }

     public function sizeSelected($productSizeId)
     {
         $this->productSizeId = $productSizeId;
         $productSize = $this->product->productSizes()->where('id', $productSizeId)->first();
         $this->prodSizeSelectedQuantity = $productSize->quantity;

     }



     public function incrementQuantity()
     {
         if( $this->quantityCount  < 20){
         $this->quantityCount++;
         }
     }

     public function decrementQuantity()
     {
         if( $this->quantityCount  > 1){
             $this->quantityCount--;
         }
     }

     public function addToCart(int $productId)
     {
         if (Auth::check()) {
             $userId = auth()->user()->id;

             if ($this->product->where('id', $productId)->exists()) {
                 $hasColor = $this->product->productColors()->count() > 0;
                 $hasSize = $this->product->productSizes()->count() > 0;

                 if ($hasColor && $hasSize) {
                     if ($this->prodColorSelectedQuantity !== null && $this->prodSizeSelectedQuantity !== null) {
                         // Both color and size selected
                         $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                         $productSize = $this->product->productSizes()->where('id', $this->productSizeId)->first();

                         if ($productColor->quantity > 0 && $productSize->quantity > 0) {
                             if ($productColor && $productSize->quantity >= $this->quantityCount) {
                                 // Color and size selected and available
                                 if ($this->isProductAlreadyAddedToCart($userId, $productId, $this->productColorId, $this->productSizeId)) {
                                     $this->dispatchBrowserEvent('message', [
                                         'text' => 'Product already added to cart',
                                         'type' => 'warning',
                                         'status' => 404
                                     ]);
                                 } else {
                                     Cart::create([
                                         'user_id' => $userId,
                                         'product_id' => $productId,
                                         'product_color_id' => $this->productColorId,
                                         'product_size_id' => $this->productSizeId,
                                         'quantity' => $this->quantityCount
                                     ]);

                                     $this->emit('CartAddedUpdated');
                                     $this->dispatchBrowserEvent('message', [
                                         'text' => 'Product added to cart successfully',
                                         'type' => 'success',
                                         'status' => 200
                                     ]);
                                 }
                             } else {
                                 $this->dispatchBrowserEvent('message', [
                                     'text' => 'Only have ' . $productColor->quantity . ' of this color and ' . $productSize->quantity . ' of this size in quantity available',
                                     'type' => 'warning',
                                     'status' => 404
                                 ]);
                             }
                         } else {
                             $this->dispatchBrowserEvent('message', [
                                 'text' => 'Out of stock',
                                 'type' => 'warning',
                                 'status' => 404
                             ]);
                         }
                     } else {
                         $this->dispatchBrowserEvent('message', [
                             'text' => 'Select your product color and size',
                             'type' => 'warning',
                             'status' => 404
                         ]);
                     }
                 } elseif ($hasColor) {
                     $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                     if ($this->prodColorSelectedQuantity !== null) {
                         if ($productColor->quantity >= $this->quantityCount) {
                             // Color selected
                             if ($this->isProductAlreadyAddedToCart($userId, $productId, $this->productColorId, null)) {
                                 $this->dispatchBrowserEvent('message', [
                                     'text' => 'Product already added to cart',
                                     'type' => 'warning',
                                     'status' => 404
                                 ]);
                             } else {
                                 Cart::create([
                                     'user_id' => $userId,
                                     'product_id' => $productId,
                                     'product_color_id' => $this->productColorId,
                                     'quantity' => $this->quantityCount
                                 ]);

                                 $this->emit('CartAddedUpdated');
                                 $this->dispatchBrowserEvent('message', [
                                     'text' => 'Product added to cart successfully',
                                     'type' => 'success',
                                     'status' => 200
                                 ]);
                             }
                         } else {
                             $this->dispatchBrowserEvent('message', [
                                 'text' => 'Only have ' . $productColor->quantity . ' of this color in quantity available',
                                 'type' => 'warning',
                                 'status' => 404
                             ]);
                         }
                     } else {
                         $this->dispatchBrowserEvent('message', [
                             'text' => 'Select your product color',
                             'type' => 'warning',
                             'status' => 404
                         ]);
                     }
                 } elseif ($hasSize) {
                     if ($this->prodSizeSelectedQuantity !== null) {
                         $productSize = $this->product->productSizes()->where('id', $this->productSizeId)->first();
                         if ($productSize->quantity >= $this->quantityCount) {
                             // Size selected
                             if ($this->isProductAlreadyAddedToCart($userId, $productId, null, $this->productSizeId)) {
                                 $this->dispatchBrowserEvent('message', [
                                     'text' => 'Product already added to cart',
                                     'type' => 'warning',
                                     'status' => 404
                                 ]);
                             } else {
                                 Cart::create([
                                     'user_id' => $userId,
                                     'product_id' => $productId,
                                     'product_size_id' => $this->productSizeId,
                                     'quantity' => $this->quantityCount
                                 ]);

                                 $this->emit('CartAddedUpdated');
                                 $this->dispatchBrowserEvent('message', [
                                     'text' => 'Product added to cart successfully',
                                     'type' => 'success',
                                     'status' => 200
                                 ]);
                             }
                         } else {
                             $this->dispatchBrowserEvent('message', [
                                 'text' => 'Only have ' . $productSize->quantity . ' of this size in quantity available',
                                 'type' => 'warning',
                                 'status' => 404
                             ]);
                         }
                     } else {
                         $this->dispatchBrowserEvent('message', [
                             'text' => 'Select your product size',
                             'type' => 'warning',
                             'status' => 404
                         ]);
                     }
                 } else {
                     if ($this->product->quantity > 0) {
                         if ($this->product->quantity >= $this->quantityCount) {
                             // No color or size selected
                             if ($this->isProductAlreadyAddedToCart($userId, $productId, null, null)) {
                                 $this->dispatchBrowserEvent('message', [
                                     'text' => 'Product already added to cart',
                                     'type' => 'warning',
                                     'status' => 404
                                 ]);
                             } else {
                                 Cart::create([
                                     'user_id' => $userId,
                                     'product_id' => $productId,
                                     'quantity' => $this->quantityCount
                                 ]);

                                 $this->emit('CartAddedUpdated');
                                 $this->dispatchBrowserEvent('message', [
                                     'text' => 'Product added to cart successfully',
                                     'type' => 'success',
                                     'status' => 200
                                 ]);
                             }
                         } else {
                             $this->dispatchBrowserEvent('message', [
                                 'text' => 'Only ' . $this->product->quantity . ' quantity available',
                                 'type' => 'warning',
                                 'status' => 404
                             ]);
                         }
                     } else {
                         $this->dispatchBrowserEvent('message', [
                             'text' => 'Out of Stock',
                             'type' => 'warning',
                             'status' => 404
                         ]);
                     }
                 }
             } else {
                 $this->dispatchBrowserEvent('message', [
                     'text' => 'Product does not exist',
                     'type' => 'warning',
                     'status' => 404
                 ]);
             }
         } else {
             $this->dispatchBrowserEvent('message', [
                 'text' => 'Please login to add to cart',
                 'type' => 'error',
                 'status' => 401
             ]);
         }
     }

     private function isProductAlreadyAddedToCart($userId, $productId, $colorId, $sizeId)
     {
         $query = Cart::where('user_id', $userId)
             ->where('product_id', $productId);

         if ($colorId !== null) {
             $query->where('product_color_id', $colorId);
         }

         if ($sizeId !== null) {
             $query->where('product_size_id', $sizeId);
         }

         return $query->exists();
     }



     public function mount( $product)
     {
         $this->product = $product;
     }

    public function render()
    {
        $wishlist = [];
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', auth()->user()->id)->pluck('product_id')->toArray();
        }
        return view('livewire.frontend.page.product-detail',[
            'product' => $this->product,
            'wishlist' => $wishlist,
        ]);
    }
}
