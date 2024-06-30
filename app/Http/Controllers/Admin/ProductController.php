<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;
use App\Models\ProductSize;
use App\Models\Size;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $colors = Color::get();
        $sizes = Size::where('status','0')->get();
        return view('admin.products.create', compact('categories','subcategories','brands','colors','sizes'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $subcategory = Subcategory::findOrFail($validatedData['subcategory_id']);

        $product = $subcategory->products()->create([
            'category_id' => $validatedData['category_id'],
            'subcategory_id' => $validatedData['subcategory_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/';

            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);

            }
        }

        if ($request->has('size')) {
            foreach ($request->size as $key => $sizeId) {
                $quantity = $request->sizequantity[$sizeId] ?? 0;

                $productSize = new ProductSize();
                $productSize->product_id = $product->id;
                $productSize->size_id = $sizeId;
                $productSize->quantity = $quantity;
                $productSize->save();
            }
        }

        if ($request->has('color')) {
            foreach ($request->color as $key => $colorId) {
                $quantity = $request->colorquantity[$colorId] ?? 0;

                $productColor = new ProductColor();
                $productColor->product_id = $product->id;
                $productColor->color_id = $colorId;
                $productColor->quantity = $quantity;
                $productColor->save();
            }
        }


        return redirect('/admin/products')->with('message', 'Product Added Successfully.');
    }

    public function edit(int $product_id)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id);
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $product_size = $product->productSizes->pluck('size_id')->toArray();
        $colors = Color::whereNotIn('id',$product_color)->get();
        $sizes = Size::whereNotIn('id',$product_size)->get();
        return view('admin.products.edit',compact('categories','subcategories','brands','product','colors','sizes'));
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();

        $product = Product::findOrFail($product_id);

        // Find the category and subcategory
        $category = Category::findOrFail($validatedData['category_id']);
        $subcategory = Subcategory::findOrFail($validatedData['subcategory_id']);

        $product->update([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
        ]);

        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i = 1;

            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        if ($request->has('size')) {
            foreach ($request->size as $key => $sizeId) {
                $quantity = $request->sizequantity[$sizeId] ?? 0;

                $productSize = new ProductSize();
                $productSize->product_id = $product->id;
                $productSize->size_id = $sizeId;
                $productSize->quantity = $quantity;
                $productSize->save();
            }
        }

        if ($request->has('color')) {
            foreach ($request->color as $key => $colorId) {
                $quantity = $request->colorquantity[$colorId] ?? 0;

                $productColor = new ProductColor();
                $productColor->product_id = $product->id;
                $productColor->color_id = $colorId;
                $productColor->quantity = $quantity;
                $productColor->save();
            }
        }

        return redirect('/admin/products')->with('message', 'Product Updated Successfully.');
    }


    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message','Product Image Deleted');
    }

    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if($product->productImages){
            foreach($product->productImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message','Product Deleted with all its image');
    }

    public function updateColorQty(Request $request, $prod_color_id)
    {
        $productColorData = Product::findOrFail($request->product_id)
                            ->productColors()->where('id',$prod_color_id)->first();
        $productColorData->update([
            'quantity' => $request->qty
        ]);
        return response()->json(['message'=>'Product Color Qty updated']);
    }
    public function deleteProdColor($prod_color_id)
    {
        $prodColor = ProductColor::findOrFail($prod_color_id);
        $prodColor->delete();
        return response()->json(['message' => 'Product Color Deleted']);
    }

    public function updateSizeQty(Request $request, $prod_size_id)
    {
        $productSizeData = Product::findOrFail($request->product_id)
                            ->productSizes()->where('id',$prod_size_id)->first();
        $productSizeData->update([
            'quantity' => $request->qty
        ]);
        return response()->json(['message'=>'Product Size Qty updated']);
    }
    public function deleteProdSize($prod_size_id)
    {
        $prodSize = ProductSize::findOrFail($prod_size_id);
        $prodSize->delete();
        return response()->json(['message' => 'Product Size Deleted']);
    }


}
