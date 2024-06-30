<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $category;
    public $brandInput = [];
    public $priceInput;

    protected $queryString = [
        'brandInput' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];

    use WishlistHelper;

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $products = Product::query()
            ->where('category_id', $this->category->id)
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

        return view('livewire.frontend.product.index', [
            'products' => $products,
            'category' => $this->category,
            'wishlist' => $wishlist,
        ]);
}



}
