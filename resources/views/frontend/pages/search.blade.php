@extends('layouts.app')

@section('title', 'Search Product')


@section('content')

<div class="py-5 ">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-10">
                    <h4>Search Results</h4>
                <div class="underline mb-4"></div>
            </div>

            <livewire:frontend.page.search-product :searchProducts="$searchProducts" />

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

