<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Frontend\Product\WishlistHelper;

class Index extends Component
{
    public $sliders, $trendingProducts, $categories, $newArrivalProducts;

    use WishlistHelper;

    public function mount($sliders, $trendingProducts, $categories, $newArrivalProducts)
    {
        $this->sliders = $sliders;
        $this->trendingProducts = $trendingProducts;
        $this->categories = $categories;
        $this->newArrivalProducts = $newArrivalProducts;

    }

    public function render()
    {
        $wishlist = [];
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', auth()->user()->id)->pluck('product_id')->toArray();
        }
        return view('livewire.frontend.index',[
            'sliders' => $this->sliders,
            'trendingProducts' => $this->trendingProducts,
            'categories' => $this->categories,
            'newArrivalProducts' => $this->newArrivalProducts,
            'wishlist' => $wishlist,
        ]);
    }
}
