<?php

namespace App\Http\Livewire\Frontend\Page;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Frontend\Product\WishlistHelper;

class AllProduct extends Component
{
    public $allProducts;
    public $brandInput = [];
    public $priceInput;

    protected $queryString = [
        'brandInput' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];

    use WishlistHelper;

    public function mount($allProducts)
    {
        $this->allProducts = $allProducts;
    }

    public function render()
    {
        $filteredProducts = Product::query()
            ->when($this->brandInput, function ($query) {
                $query->whereIn('brand', $this->brandInput);
            })
            ->when($this->priceInput, function ($query) {
                $query->orderBy('selling_price', $this->priceInput == 'low-to-high' ? 'ASC' : 'DESC');
            })
            ->get();

        $wishlist = [];
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', auth()->user()->id)->pluck('product_id')->toArray();
        }

        return view('livewire.frontend.page.all-product', [
            'filteredProducts' => $filteredProducts,
            'allProducts' => $this->allProducts,
            'wishlist' => $wishlist,
        ]);
    }
}


