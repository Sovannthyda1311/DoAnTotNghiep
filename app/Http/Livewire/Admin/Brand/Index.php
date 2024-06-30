<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $slug, $brand_id;
    public $sort = 'id';

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string'
        ];
    }

    public function resetInput()
    {
        $this->name = null;
        $this->slug = null;
        $this->brand_id = null;
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();

        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug)
        ]);

        session()->flash('message', 'Brand Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
               $this->name = $brand->name;
               $this->slug = $brand->slug;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();

        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug)
        ]);

        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();

    }

    public function render()
    {
        $brands = Brand::orderBy($this->sort)->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands])
            ->extends('layouts.admin')
            ->section('content');
    }
}


