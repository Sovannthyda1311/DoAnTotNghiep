@extends('layouts.app')

@section('title')
{{$subcategory->category->name}} {{ $subcategory->name}}
@endsection


@section('content')

<div class="py-5 ">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                    <h4>Our {{$subcategory->category->name}} {{$subcategory->name}} Products</h4>
                <div class="underline mb-4"></div>
            </div>

            <livewire:frontend.product.prod-subcate :subcategory="$subcategory" :products="$products"/>

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
