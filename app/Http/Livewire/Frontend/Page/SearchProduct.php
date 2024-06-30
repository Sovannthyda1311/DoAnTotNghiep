<?php

namespace App\Http\Livewire\Frontend\Page;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Frontend\Product\WishlistHelper;

class SearchProduct extends Component
{
    protected $searchProducts;

    use WishlistHelper;

    public function mount($searchProducts)
    {
        $this->searchProducts = $searchProducts;
    }

    public function render()
    {
        $wishlist = [];
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', auth()->user()->id)->pluck('product_id')->toArray();
        }
        return view('livewire.frontend.page.search-product',[
            'searchProducts' => $this->searchProducts,
            'wishlist' => $wishlist,
        ]);
    }
}
