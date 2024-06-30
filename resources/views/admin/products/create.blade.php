@extends('layouts.admin')

@section('title', 'Add Products')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Products</h3>
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

                <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                            <button class="nav-link" id="size-tab" data-bs-toggle="tab"
                                data-bs-target="#size-tab-pane" type="button" role="tab" aria-controls="size-tab-pane"
                                aria-selected="false">
                                Product Size
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab"
                                data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane"
                                aria-selected="false">
                                Product Color
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content mt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Product Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" class="form-control" id="category" onchange="updateSubcategories()">
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="mb-3">
                                <label for="subcategory" class="form-label">Sub Category</label>
                                <select name="subcategory_id" class="form-control" id="subcategory">
                                  <!-- Options will be dynamically populated using JavaScript -->
                                </select>
                              </div>

                              <script>
                                var subcategories = {!! json_encode($subcategories->groupBy('category_id')) !!};

                                // Initial population of subcategory dropdown
                                updateSubcategories();

                                function updateSubcategories() {
                                  var categoryId = document.getElementById('category').value;
                                  var subcategoryDropdown = document.getElementById('subcategory');
                                  subcategoryDropdown.innerHTML = '';

                                  // Filter the subcategories based on the selected category
                                  var filteredSubcategories = subcategories[categoryId];
                                  filteredSubcategories.forEach(function(subcategory) {
                                    var option = document.createElement('option');
                                    option.value = subcategory.id;
                                    option.textContent = subcategory.name;
                                    subcategoryDropdown.appendChild(option);
                                  });
                                }
                              </script>

                            <div class="mb-3">
                                <label for="brand" class="form-label">Select Brand</label>
                                <select name="brand" class="form-control" id="brand">
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="small_description" class="form-label">Small Description (500 Words)</label>
                                <textarea name="small_description" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="original_price" class="form-label">Original Price</label>
                                        <input type="text" name="original_price" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="selling_price" class="form-label">Selling Price</label>
                                        <input type="text" name="selling_price" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="trending" class="form-label">Trending</label>
                                        <input type="checkbox" name="trending" style="width: 20px; height: 20px;">
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
                        </div>
                        <div class="tab-pane fade" id="size-tab-pane" role="tabpanel" aria-labelledby="size-tab"
                        tabindex="0">
                            <div class="mb-3">
                                <label for="color">Select Size</label>
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
                                        <h1>No sizes found</h1>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab"
                        tabindex="0">
                            <div class="mb-3">
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
                       </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-save"></i> Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
