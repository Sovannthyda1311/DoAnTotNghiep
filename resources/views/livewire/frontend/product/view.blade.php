<div>
    <div class="py-3 py-md-5 ">
        <div class="container">

            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                        {{-- <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img"> --}}
                        <div class="exzoom" id="exzoom">

                            <div class="exzoom_img_box">
                              <ul class='exzoom_img_ul'>
                                @foreach ($product->productImages as $itemImage)
                                    <li><img src="{{ asset($itemImage->image) }}" class="w-100"/></li>
                                @endforeach
                              </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                          </div>
                        @else
                        No Image Added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name}}
                            @if ($product->quantity)
                                <label class="label-stock in-stock" style="float: right;">In Stock</label>
                            @else
                                <label class="label-stock out-of-stock" style="float: right;">Out of Stock</label>
                            @endif
                        </h4>
                        <hr>
                        <p class="product-path" style="  color:brown;  font-family: var(--font-stack-header);">
                            Home / {{ $product->category->name}} / {{ $product->name}}
                        </p>
                        <div>
                            <span class="selling-price">${{ $product->selling_price}}</span>
                            <span class="original-price">${{ $product->original_price}}</span>
                        </div>

                        <div>
                            {{-- <span style="font-family: var(--font-stack-header);">Color :</span><br/> --}}
                            @if ($product->productColors->count() > 0)
                                @if ($product->productColors)
                                    @foreach ($product->productColors as $colorItem)
                                        <label class="colorSelectionLabel" style="background-color: {{$colorItem->color->code}} " wire:click="colorSelected({{$colorItem->id}})">
                                            {{$colorItem->color->name}}
                                        </label>
                                    @endforeach
                                @endif

                                @if ($this->prodColorSelectedQuantity == 'outofstock')
                                    <label class="label-stock out-of-stock">Out of Stock</label>
                                @elseif ($this->prodColorSelectedQuantity > 0)
                                    <label class="label-stock in-stock">In Stock</label>
                                @endif
                            @endif
                        </div>

                        <div>
                            @if ($product->productSizes)
                                <span style="font-family: var(--font-stack-header); display: inline-block;">Size :</span><br/>
                                @foreach ($product->productSizes as $sizeItem)
                                    <div class="radio-wrapper" style="display: inline-block; margin-right: 10px;">
                                        <input type="radio" name="sizeSelection" value="{{$sizeItem->id}}"
                                            {{$sizeItem->quantity == 0 ? 'disabled' : ''}} wire:click="sizeSelected({{$sizeItem->id}})" />
                                        <label style="{{$sizeItem->quantity == 0 ? 'color: #999; cursor: not-allowed;' : ''}}">
                                            {{$sizeItem->size->name}}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>


                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn1"> <i class="fa fa-shopping-cart"></i>
                                 Add To Cart
                            </button>
                            <button type="button" wire:click="addToWishList({{$product->id}})" class="btn btn1">
                                <i class="fa fa-heart{{ in_array($product->id, $wishlist) ? '' : '-o' }}" style="{{ in_array($product->id, $wishlist) ? 'color: #B61f28;' : '' }}"></i> Add To Wishlist
                            </button>
                        </div>
                        <div class="mt-3" style="font-family: var(--font-stack-header);">
                            <h5 class="mb-0">
                                COMPOSITION, ORIGIN AND PRECAUTIONS
                            </h5>
                            <p style="color: var(--content-1);">
                                {!! nl2br(e($product->small_description)) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card" style="font-family: var(--font-stack-header);">
                        <div class="card-header bg-white" >
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!! nl2br(e($product->description)) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Related Products</h3>
                    <div class="underline"></div>
                </div>
                @foreach ($category->products->where('subcategory_id', $product->subcategory_id) as $relatedProductItem)
                    @if ($relatedProductItem->id !== $product->id)
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="product-card">
                                <div class="product-card-img">
                                    @if ($relatedProductItem->quantity > 0)
                                        <label class="stock">In Stock</label>
                                    @else
                                        <label class="out_stock">Sold out</label>
                                    @endif

                                    <label class="discount">
                                        @if ($relatedProductItem->original_price && $relatedProductItem->selling_price)
                                            <?php
                                            $discountPercentage = (($relatedProductItem->original_price - $relatedProductItem->selling_price) / $relatedProductItem->original_price) * 100;
                                            ?>
                                            -{{ round($discountPercentage) }}%
                                        @endif
                                    </label>
                                    @if ($relatedProductItem->productImages->count() > 1)
                                        <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                            <img id="product-image-{{ $relatedProductItem->id }}" src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->name }}" data-first-image="{{ asset($relatedProductItem->productImages[0]->image) }}" data-second-image="{{ asset($relatedProductItem->productImages[1]->image) }}" onmouseover="showSecondImage(this)" onmouseout="showFirstImage(this)">
                                        </a>
                                    @else
                                        <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                            <img id="product-image-{{ $relatedProductItem->id }}" src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->name }}">
                                        </a>
                                    @endif
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                    <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                        <h5 class="product-name">{{ $relatedProductItem->name }}</h5>
                                    </a>
                                    <div>
                                        <span class="selling-price">${{ $relatedProductItem->selling_price }}</span>
                                        <span class="original-price">${{ $relatedProductItem->original_price }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn1" wire:click="addToWishList({{ $relatedProductItem->id }})">
                                            <i class="fa fa-heart{{ in_array($relatedProductItem->id, $wishlist) ? '' : '-o' }}" style="{{ in_array($relatedProductItem->id, $wishlist) ? 'color: #B61f28;' : '' }}"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


</div>

@push('scripts')
    <script>
        $(function(){

            $("#exzoom").exzoom({
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": false,
                "autoPlayTimeout": 2000
            });
        });
    </script>
@endpush
