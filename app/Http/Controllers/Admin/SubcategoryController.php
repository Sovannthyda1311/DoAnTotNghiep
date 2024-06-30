<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryFormRequest;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    public function store(SubcategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);
        $subcategory = $category->subcategories()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),

        ]);

        return redirect('/admin/subcategories')->with('message','Sub Category Added Successfully');
    }

    public function edit(int $subcategory_id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::findOrFail($subcategory_id);
        return view('admin.subcategory.edit', compact('categories','subcategory'));
    }

    public function update(SubcategoryFormRequest $request, int $subcategory_id)
    {
        $validatedData = $request->validated();

        $subcategory = Subcategory::findOrFail($subcategory_id);
        $category = Category::findOrFail($validatedData['category_id']);

        if ($subcategory && $category) {
            $subcategory->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
            ]);

            return redirect('/admin/subcategories')->with('message', 'Sub Category Updated Successfully');
        } else {
            return redirect('admin/subcategories')->with('message', 'Invalid Sub Category or Category ID');
        }
    }


    public function destroy(int $subcategory_id)
    {
        $subcategory = Subcategory::findOrFail($subcategory_id);
        $subcategory->delete();
        return redirect()->back()->with('message','Sub Category Deleted');
    }


}
