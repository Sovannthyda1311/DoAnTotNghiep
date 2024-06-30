@extends('layouts.app')

@section('title', 'All Products')


@section('content')

<div class="py-5 ">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                    <h4>Our All Products</h4>
                <div class="underline mb-4"></div>
            </div>

            <livewire:frontend.page.all-product :allProducts="$allProducts" />

        </div>
    </div>
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
