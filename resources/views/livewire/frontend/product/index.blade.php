<div>

    <div class="row">
        <div class="col-md-12">
            <div class="dropdown" style="margin-bottom: 10px;">
                <span class="dropbtn"><i class="fa fa-filter"></i> Filter and Sort </span>
                <div class="dropdown-content">
                    <div class="card">
                        <div class="card-header" style="font-family: var(--font-stack-header);">
                            <h5>BRAND</h5>
                        </div>
                        <div class="card-body" style="color: brown; font-family: var(--font-stack-header);">
                            @foreach ($category->products->pluck('brand')->unique() as $brand)
                                <label class="d-block">
                                    <input type="checkbox" wire:model="brandInput" value="{{ $brand }}" /> {{ $brand }}
                                </label>
                            @endforeach
                        </div>
                        <div class="card-header" style="font-family: var(--font-stack-header);">
                            <h5>PRICE</h5>
                        </div>
                        <div class="card-body" style="color: brown; font-family: var(--font-stack-header);">
                                <label class="d-block">
                                    <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high" /> Low to High
                                </label>
                                <label class="d-block">
                                    <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low" /> High to Low
                                </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @forelse ($products as $productItem)

                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if ($productItem->quantity > 0)
                            <label class="stock">In Stock</label>
                            @else
                            <label class="out_stock">Sold out</label>
                            @endif

                            <label class="discount">
                                @if ($productItem->original_price && $productItem->selling_price)
                                    <?php
                                    $discountPercentage = (($productItem->original_price - $productItem->selling_price) / $productItem->original_price) * 100;
                                    ?>
                                -{{ round($discountPercentage) }}%
                            @endif
                            </label>

                            @if ($productItem->productImages->count() > 1)
                                <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                    <img id="product-image-{{ $productItem->id }}" src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}" data-first-image="{{ asset($productItem->productImages[0]->image) }}" data-second-image="{{ asset($productItem->productImages[1]->image) }}" onmouseover="showSecondImage(this)" onmouseout="showFirstImage(this)">
                                </a>
                            @else
                                <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                    <img id="product-image-{{ $productItem->id }}" src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}">
                                </a>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{ $productItem->brand }}</p>
                            <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                            <h5 class="product-name">
                                {{ $productItem->name }}
                            </h5>
                            </a>
                            <div>
                                <span class="selling-price">${{ $productItem->selling_price }}</span>
                                <span class="original-price">${{ $productItem->original_price }}</span>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn1" wire:click="addToWishList({{ $productItem->id }})">
                                    <i class="fa fa-heart{{ in_array($productItem->id, $wishlist) ? '' : '-o' }}" style="{{ in_array($productItem->id, $wishlist) ? 'color: #B61f28;' : '' }}"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h5>No Products Available for {{ $category->name}}</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
