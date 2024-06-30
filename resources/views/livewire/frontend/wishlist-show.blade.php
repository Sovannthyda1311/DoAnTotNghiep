<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <h4>My WishList</h4>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>PRODUCTS</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>PRICE</h4>
                                </div>
                                <div class="col-md-4">
                                    <h4>REMOVE</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($wishlist as $wishlistItem)
                            @if ($wishlistItem->product)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a href="{{url('collections/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug)}}">
                                            <label class="product-name">
                                                <img src="{{$wishlistItem->product->productImages[0]->image}}" style="width: 100px; height: 133px" alt="{{$wishlistItem->product->name}}">
                                                {{$wishlistItem->product->name}}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label class="price">${{$wishlistItem->product->selling_price}} </label>
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            <button type="button" wire:click="removeWhishlistItem({{$wishlistItem->id}})" class="btn btn-danger btn-sm">
                                                <span wire:loading.remove wire:target="removeWhishlistItem({{$wishlistItem->id}})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target="removeWhishlistItem({{$wishlistItem->id}})">
                                                    <i class="fa fa-trash"></i> Removing
                                                </span>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty
                            <h4>No Wishlist Added</h4>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
