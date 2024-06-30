<div>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="footer-heading">{{$appSetting->website_name ?? 'website name'}}</h4>
                    <div class="footer-underline"></div>
                    <p style="font-family: var(--font-stack-header);">
                        We curate a wide range of stylish and high-quality clothing for all occasions. Shop with ease on our user-friendly website and enjoy exceptional customer service. Start exploring our collection today!
                    </p>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Quick Links</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="{{'/'}}" class="text-black"><i class="fa fa-home"></i> Home</a></div>
                    <div class="mb-2"><a href="{{'/about-us'}}" class="text-black"><i class="fa fa-info-circle"></i> About Us</a></div>
                    <div class="mb-2"><a href="{{'/contact-us'}}" class="text-black"><i class="fa fa-envelope"></i> Contact Us</a></div>
                    <div class="mb-2"><a href="{{'/blogs'}}" class="text-black"><i class="fa fa-book"></i> Blogs</a></div>
                    <div class="mb-2"><a href="#" class="text-black"><i class="fa fa-sitemap"></i> Sitemaps</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Shop Now</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="{{'/collections'}}" class="text-black"><i class="fa fa-th"></i> Collections</a></div>
                    <div class="mb-2"><a href="{{'/'}}" class="text-black"><i class="fa fa-fire"></i> Trending Products</a></div>
                    <div class="mb-2"><a href="{{'/new-arrivals'}}" class="text-black"><i class="fa fa-clock-o"></i> New Arrivals Products</a></div>
                    <div class="mb-2"><a href="#" class="text-black"><i class="fa fa-star"></i> Featured Products</a></div>
                    <div class="mb-2"><a href="{{'/cart'}}" class="text-black"><i class="fa fa-shopping-cart"></i> Cart</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Reach Us</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2">
                        <p>
                            <i class="fa fa-map-marker"></i> {{$appSetting->address ?? 'address'}}
                        </p>
                    </div>
                    <div class="mb-2">
                        <a href="#" class="text-black">
                            <i class="fa fa-phone"></i> {{$appSetting->phone1 ?? 'phone 1'}}
                        </a>
                    </div>
                    <div class="mb-2">
                        <a href="mailto:{{$appSetting->email1}}" class="text-black">
                            <i class="fa fa-envelope"></i> {{$appSetting->email1 ?? 'email 1'}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class=""> &copy; 2024 - Hul Sovannthyda - Online Clothes. All rights reserved.</p>
                </div>
                <div class="col-md-4">
                    <div class="social-media">
                        Get Connected:
                        @if ($appSetting->facebook)
                        <a href="{{$appSetting->facebook}}"><i class="fa fa-facebook fa-lg"></i></a>
                        @endif
                        @if ($appSetting->twitter)
                        <a href="{{$appSetting->twitter}}"><i class="fa fa-twitter fa-lg"></i></a>
                        @endif
                        @if ($appSetting->instagram)
                        <a href="{{$appSetting->instagram}}"><i class="fa fa-instagram fa-lg"></i></a>
                        @endif
                        @if ($appSetting->youtube)
                        <a href="{{$appSetting->youtube}}"><i class="fa fa-youtube fa-lg"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
