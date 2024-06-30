<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ProdSubcate extends Component
{
    public $subcategory, $products;

    use WishlistHelper;

    public $brandInput = [];
    public $priceInput;

    protected $queryString = [
        'brandInput' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];

    public function mount($subcategory, $products)
    {
        $this->subcategory = $subcategory;
        $this->products = $products;
    }

    public function render()
    {
        $this->products = Product::query()
            ->where('subcategory_id', $this->subcategory->id)
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

        return view('livewire.frontend.product.prod-subcate', [
            'products' => $this->products,
            'subcategory' => $this->subcategory,
            'wishlist' => $wishlist,
        ]);
    }

}
