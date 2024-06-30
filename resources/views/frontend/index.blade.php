@extends('layouts.app')

@section('title', 'Home Page')


@section('content')

<div>
    <livewire:frontend.index :sliders="$sliders" :trendingProducts="$trendingProducts" :categories="$categories" :newArrivalProducts="$newArrivalProducts" />
</div>

@endsection


@section('script')

    <script>
        $('.four-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
    </script>

<script>
    function showSecondImage(imageElement) {
        const secondImage = imageElement.dataset.secondImage;
        if (secondImage) {
            imageElement.src = secondImage;
        }
    }

    function showFirstImage(imageElement) {
        const firstImage = imageElement.dataset.firstImage;
        if (firstImage) {
            imageElement.src = firstImage;
        }
    }
</script>


@endsection
