<div>
    <div class="row justify-content-center">
        @forelse ($searchProducts as $productItem)

        <div class="col-md-10">
            <div class="product-card">
                <div class="row">
                    <div class="col-md-3">
                        <div class="product-card-img">
                            <label class="stock"> In stock </label>
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
                    </div>
                    <div class="col-md-9">
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
                            <p style="height: 45px; overflow:hidden">
                                <b>Description : </b>{{ $productItem->description }}
                            </p>
                            <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}" class="btn btn-outline-primary"> View </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @empty
            <div class="col-md-10 p-2">
                <h5>No Products Found</h5>
            </div>
        @endforelse

        <div>{{$searchProducts->appends(request()->input())->links()}}</div>
    </div>
</div>
