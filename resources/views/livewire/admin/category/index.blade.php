
<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Category Delete</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyCategory">
                <div class="modal-body">
                    <h6>Are you sure, you want to delete this data?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close </button>
                    <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-trash"></i> Yes, Delete </button>
                </div>
            </form>
          </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 ">

            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>category
                        <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm float-end text-white">
                            <i class="fa fa-plus"></i> Add Category
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories->sortBy('id') as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <img src="{{ asset("$category->image" )}}" width="60px" height="60px"/>
                                </td>
                                <td>
                                    <a href="{{ url('admin/category/'.$category->id.'/edit')}}" class="btn btn-sm btn-success text-white">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <a href="#" wire:click="deleteCategory({{$category->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-danger text-white">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('script')
<script>
    window.addEventListener('close-modal',event =>{
        $('#deleteModal').modal('hide');
    });
</script>
@endpush
