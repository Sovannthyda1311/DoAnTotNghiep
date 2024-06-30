<div>
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">

                @foreach ($sliders as $key => $sliderItem )

                <div class="carousel-item {{ $key == 0 ? 'active':''}} ">
                        @if ($sliderItem->image)
                            <img src="{{ asset("$sliderItem->image")}}" class="d-block w-100" alt="...">
                        @endif
                        <div class="carousel-caption d-none d-md-block">
                            <div class="custom-carousel-content">
                                <h1>
                                    {!! $sliderItem->title !!}
                                </h1>
                                <p>
                                    {!! $sliderItem->description !!}
                                </p>
                                <div>
                                    <a href="{{url('/all-products')}}" class="btn btn-slider" style="background-color: #333; color: #fff; padding: 12px 24px; border-radius: 25px; text-decoration: none; display: inline-block; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); transition: background-color 0.3s;">
                                        &gt;&gt; SEE MORE COLLECTION
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Welcom to ONLINE CLOTHES</h4>
                    <div class="underline mx-auto"></div>
                    <p style="font-family: var(--font-stack-header);">
                        Discover the latest trends, shop stylish outfits, and express your unique fashion sense. We're here to help you look and feel fabulous. Start exploring our collection today!
                    </p>
                </div>
            </div>
        </div>
        </div>

        <div class="py-3 bg-white">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h4>Our Collections</h4>
                        <div class="underline mb-4"></div>
                    </div>

                    @if ($categories)
                    <div class="col-md-12" wire:ignore >
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($categories as $categoryItem)

                            <div class="item">
                                <div class="category-card">
                                    <a href="{{ url('/collections/'.$categoryItem->slug)}}">
                                        <div class="category-card-img">
                                            <img src="{{ asset("$categoryItem->image") }}" class="w-100" alt="{{$categoryItem->name}}">
                                        </div>
                                        <div class="category-card-body">
                                            <h5>{{$categoryItem->name}}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h5>No Collections Available</h5>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="py-2 ">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h4>New Arrival Products</h4>
                        <div class="underline mb-4"></div>
                    </div>

                    @forelse ($newArrivalProducts as $productItem)
                    <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-success"> New </label>
                                <label class="discount">
                                    @if ($productItem->original_price && $productItem->selling_price)
                                        <?php
                                        $discountPercentage = (($productItem->original_price - $productItem->selling_price) / $productItem->original_price) * 100;
                                        ?>
                                    -{{ round($discountPercentage) }}%
                                @endif
                                </label>

                                @if ($productItem->productImages->count() > 1)
                                    <a href="{{ url('/product-details/'.$productItem->slug)}}">
                                        <img id="product-image-{{ $productItem->id }}" src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}" data-first-image="{{ asset($productItem->productImages[0]->image) }}" data-second-image="{{ asset($productItem->productImages[1]->image) }}" onmouseover="showSecondImage(this)" onmouseout="showFirstImage(this)">
                                    </a>
                                @else
                                    <a href="{{ url('/product-details/'.$productItem->slug)}}">
                                        <img id="product-image-{{ $productItem->id }}" src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}">
                                    </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $productItem->brand }}</p>
                                <a href="{{ url('/product-details/'.$productItem->slug)}}">
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
                        <div class="col-md-12 p-2">
                            <h5>No Products Available</h5>
                        </div>
                @endforelse
                </div>
            </div>
        </div>

        <div class="py-2 ">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h4>Trending Products</h4>
                        <div class="underline mb-4"></div>
                    </div>

                        @forelse ($trendingProducts as $productItem)
                            <div class="col-md-3">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <label class="stock"> Hot </label>
                                        <label class="discount">
                                            @if ($productItem->original_price && $productItem->selling_price)
                                                <?php
                                                $discountPercentage = (($productItem->original_price - $productItem->selling_price) / $productItem->original_price) * 100;
                                                ?>
                                            -{{ round($discountPercentage) }}%
                                        @endif
                                        </label>

                                        @if ($productItem->productImages->count() > 1)
                                            <a href="{{ url('/product-details/'.$productItem->slug)}}">
                                                <img id="product-image-{{ $productItem->id }}" src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}" data-first-image="{{ asset($productItem->productImages[0]->image) }}" data-second-image="{{ asset($productItem->productImages[1]->image) }}" onmouseover="showSecondImage(this)" onmouseout="showFirstImage(this)">
                                            </a>
                                        @else
                                            <a href="{{ url('/product-details/'.$productItem->slug)}}">
                                                <img id="product-image-{{ $productItem->id }}" src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $productItem->brand }}</p>
                                        <a href="{{ url('/product-details/'.$productItem->slug)}}">
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
                                <div class="col-md-12 p-2">
                                    <h5>No Products Available</h5>
                                </div>
                        @endforelse
                </div>
            </div>
        </div>

</div>
