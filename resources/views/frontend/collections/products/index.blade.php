@extends('layouts.app')

@section('title')
{{ $category->name}}
@endsection

@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <h4 class="mb-4" style="font-family: var(--font-stack-header);">
                            ALL {{$category->name}} PRODUCTS
                    </h4>
            </div>


            <livewire:frontend.product.index :category="$category" />

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
