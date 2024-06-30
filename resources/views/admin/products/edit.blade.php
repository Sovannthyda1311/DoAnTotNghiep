@extends('layouts.admin')

@section('title', 'Edit Products')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <h5 class="alert alert-success">
                {{ session('message') }}
            </h5>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Products</h3>
                <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-arrow-left"></i> BACK </a>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">
                                Home
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#details-tab-pane" type="button" role="tab"
                                aria-controls="details-tab-pane" aria-selected="false">
                                Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane"
                                aria-selected="false">
                                Product Image
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sizes-tab" data-bs-toggle="tab"
                                data-bs-target="#sizes-tab-pane" type="button" role="tab">
                                Product Sizes
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="colors-tab" data-bs-toggle="tab"
                                data-bs-target="#colors-tab-pane" type="button" role="tab">
                                Product Colors
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content mt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" value="{{ $product->name}}" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Product Slug</label>
                                <input type="text" name="slug" value="{{ $product->slug}}" class="form-control" id="slug">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" class="form-control" id="category" onchange="updateSubcategories()">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subcategory" class="form-label">Sub Category</label>
                                <select name="subcategory_id" class="form-control" id="subcategory">
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }} data-category="{{ $subcategory->category_id }}">
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <script>
                                var subcategoryDropdown = document.getElementById('subcategory');
                                var subcategories = {!! $subcategories !!};

                                // Function to filter and populate subcategories based on the selected category
                                function updateSubcategories() {
                                    var categoryId = document.getElementById('category').value;
                                    subcategoryDropdown.innerHTML = '';

                                    // Filter subcategories based on the selected category
                                    var filteredSubcategories = subcategories.filter(function(subcategory) {
                                        return subcategory.category_id == categoryId;
                                    });

                                    // Iterate over filtered subcategories and populate the dropdown
                                    filteredSubcategories.forEach(function(subcategory) {
                                        var option = document.createElement('option');
                                        option.value = subcategory.id;
                                        option.textContent = subcategory.name;
                                        option.selected = subcategory.id == {{ $product->subcategory_id }};
                                        subcategoryDropdown.appendChild(option);
                                    });
                                }

                                // Initial call to populate subcategories based on the selected category
                                updateSubcategories();
                            </script>

                            <div class="mb-3">
                                <label for="brand" class="form-label">Select Brand</label>
                                <select name="brand" class="form-control" id="brand">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}" {{ $brand->name == $product->brand ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="small_description" class="form-label">Small Description (500 Words)</label>
                                <textarea name="small_description" class="form-control" rows="4">{{ $product->small_description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ $product->description}}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="original_price" class="form-label">Original Price</label>
                                        <input type="text" name="original_price" value="{{ $product->original_price}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="selling_price" class="form-label">Selling Price</label>
                                        <input type="text" name="selling_price" value="{{ $product->selling_price}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" name="quantity" value="{{ $product->quantity}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="trending" class="form-label">Trending</label>
                                        <input type="checkbox" name="trending" {{$product->trending == '1' ? 'checked':''}} style="width: 20px; height: 20px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"
                            tabindex="0">
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Product Images</label>
                                <input type="file" name="image[]" multiple class="form-control">
                            </div>
                            <div>
                                @if($product->productImages)
                                    <div class="row">
                                        @foreach($product->productImages as $image)
                                        <div class="col-md-2">
                                            <div>
                                                <img src="{{ asset($image->image) }}" style="width: 80px; height: 80px;" class="me-4 border" alt="Image" />
                                            </div>
                                            <a href="{{ url('admin/product-image/'.$image->id.'/delete') }}" class="btn btn-sm btn-danger text-white mt-2"><i class="fa fa-trash"></i> Remove </a>
                                        </div>
                                        @endforeach
                                    </div>

                                @else
                                    <h5>No Image Added</h5>
                                @endif
                            </div>

                        </div>

                        <div class="tab-pane fade" id="sizes-tab-pane" role="tabpanel"
                        tabindex="0">
                            <div class="mb-3">
                                <h4>Add Product Size</h4>
                                <label for="size">Select Size</label>
                                <hr/>
                                <div class="row">
                                    @forelse ($sizes as $sizeitem)
                                    <div class="col-md-3">
                                        <div class="p-2 border mb-3">
                                            Size:
                                            <input type="checkbox" name="size[]" value="{{ $sizeitem->id }}" />
                                            {{ $sizeitem->name }}
                                            <br/>
                                            Quantity:
                                            <input type="number" name="sizequantity[{{ $sizeitem->id }}]" style="width: 70px; border: 1px solid"/>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-md-12">
                                        <h1>No Sizes found</h1>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->productSizes as $prodSize)
                                        <tr class="prod-size-tr">
                                            <td>
                                                @if ($prodSize->size)
                                                {{$prodSize->size->name}}
                                                @else
                                                No Size Found
                                                @endif
                                            </td>
                                            <td>
                                                <div class="input-group mb-3" style="width: 150px">
                                                    <input type="text" value="{{$prodSize->quantity}}" class="productSizeQuantity form-control form-control-sm" />
                                                    <button type="button" value="{{$prodSize->id}}" class="updateProductSizeBtn btn btn-primary btn-sm text-white"><i class="fa fa-edit"></i> Update </button>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" value="{{$prodSize->id}}" class="deleteProductSizeBtn btn btn-danger btn-sm text-white"><i class="fa fa-trash"></i> Delete </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="colors-tab-pane" role="tabpanel"
                        tabindex="0">
                            <div class="mb-3">
                                <h4>Add Product Color</h4>
                                <label for="color">Select Color</label>
                                <hr/>
                                <div class="row">
                                    @forelse ($colors as $coloritem)
                                    <div class="col-md-3">
                                        <div class="p-2 border mb-3">
                                            Color:
                                            <input type="checkbox" name="color[]" value="{{ $coloritem->id }}" />
                                            {{ $coloritem->name }}
                                            <br/>
                                            Quantity:
                                            <input type="number" name="colorquantity[{{ $coloritem->id }}]" style="width: 70px; border: 1px solid"/>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-md-12">
                                        <h1>No colors found</h1>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Color Name</th>
                                            <th>Quantity</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->productColors as $prodColor)
                                        <tr class="prod-color-tr">
                                            <td>
                                                @if ($prodColor->color)
                                                {{$prodColor->color->name}}
                                                @else
                                                No Color Found
                                                @endif
                                            </td>
                                            <td>
                                                <div class="input-group mb-3" style="width: 150px">
                                                    <input type="text" value="{{$prodColor->quantity}}" class="productColorQuantity form-control form-control-sm" />
                                                    <button type="button" value="{{$prodColor->id}}" class="updateProductColorBtn btn btn-primary btn-sm text-white"><i class="fa fa-edit"></i> Update </button>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" value="{{$prodColor->id}}" class="deleteProductColorBtn btn btn-danger btn-sm text-white"><i class="fa fa-trash"></i> Delete </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 float-end">
                        <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-edit"></i> Upadate </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<script>
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click','.updateProductSizeBtn', function(){
            var product_id = "{{ $product->id }}";
            var prod_size_id = $(this).val();
            var qty = $(this).closest('.prod-size-tr').find('.productSizeQuantity').val();

            if(qty <= 0){
                alert('Quantity is required');
                return false;
            }

            var data = {
                'product_id': product_id,
                'qty': qty
            };

            $.ajax({
                type: "POST",
                url: "/admin/product-size/"+prod_size_id,
                data: data,
                success: function(response){
                    alert(response.message)
                }
            });

        });

        $(document).on('click', '.deleteProductSizeBtn', function(){
            var prod_size_id = $(this).val();
            var thisClick = $(this);

            $.ajax({
                type: "GET",
                url: "/admin/product-size/"+prod_size_id+"/delete",
                success: function(response){
                    thisClick.closest('.prod-size-tr').remove();
                    alert(response.message);
                }
            });
        });

        $(document).on('click','.updateProductColorBtn', function(){
            var product_id = "{{ $product->id }}";
            var prod_color_id = $(this).val();
            var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();

            if(qty <= 0){
                alert('Quantity is required');
                return false;
            }

            var data = {
                'product_id': product_id,
                'qty': qty
            };

            $.ajax({
                type: "POST",
                url: "/admin/product-color/"+prod_color_id,
                data: data,
                success: function(response){
                    alert(response.message)
                }
            });

        });

        $(document).on('click', '.deleteProductColorBtn', function(){
            var prod_color_id = $(this).val();
            var thisClick = $(this);

            $.ajax({
                type: "GET",
                url: "/admin/product-color/"+prod_color_id+"/delete",
                success: function(response){
                    thisClick.closest('.prod-color-tr').remove();
                    alert(response.message);
                }
            });
        });

    });
</script>

@endsection
