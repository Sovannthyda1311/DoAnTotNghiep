<!--add brand modal -->
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brands</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeBrand">

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Brand Name</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Slug</label>
                        <input type="text" wire:model.defer="slug" class="form-control">
                        @error('slug')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary btn-sm text-white" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close </button>
                    <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-save"></i> Save </button>
                </div>

            </form>
        </div>
    </div>
</div>



<!--Brand update modal -->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Brands</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateBrand">

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Brand Name</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Slug</label>
                        <input type="text" wire:model.defer="slug" class="form-control">
                        @error('slug')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary btn-sm text-white" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close </button>
                    <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-edit"></i> Update </button>
                </div>

            </form>
        </div>
    </div>
</div>


<!--Brand delete modal -->
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brands</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyBrand({{ $brand_id }})">

                <div class="modal-body">
                    <h4>Are you sure, you want to delete this brand?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary btn-sm text-white" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close </button>
                    <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-trash"></i> Yes, Delete </button>
                </div>

            </form>
        </div>
    </div>
</div>

