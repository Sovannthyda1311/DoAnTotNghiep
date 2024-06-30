@extends('layouts.app')

@section('title')
{{ $product->name}}
@endsection

@section('content')

<div>
    <livewire:frontend.product.view :category="$category" :product="$product" />
</div>


@endsection

@section('script')

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
