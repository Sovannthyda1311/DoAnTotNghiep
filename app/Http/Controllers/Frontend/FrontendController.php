<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status','0')->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(12)->get();
        $categories = Category::get();
        $newArrivalProducts = Product::latest()->take(8)->get();

        return view('frontend.index', compact('sliders', 'trendingProducts', 'categories', 'newArrivalProducts'));
    }

    public function searchProducts(Request $request)
    {
        if($request->search){

            $searchProducts = Product::where('name', 'LIKE', '%'.$request->search.'%')->latest()->paginate(10);

            return view('frontend.pages.search', compact('searchProducts'));
        }else{

            return redirect()->back()->with('message', 'Empty Search');
        }
    }

    public function newArrival()
    {
        $newArrivalProducts = Product::latest()->take(16)->get();

        return view('frontend.pages.new-arrival', compact('newArrivalProducts'));
    }

    public function allProducts()
    {
        $allProducts = Product::get();

        return view('frontend.pages.all-product', compact('allProducts'));
    }

    public function productDetails(string $product_slug)
    {
            $product = Product::where('slug', $product_slug)->first();
            if($product)
            {
            return view('frontend.pages.product-details', compact('product'));
            }else{
                return redirect()->back();
            }
    }

    public function categories()
    {
        $categories = Category::get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();

        if($category){
            return view('frontend.collections.products.index', compact('category'));
        }
        else{
            return redirect()->back();
        }

    }
    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug',$category_slug)->first();


        if($category){

            $product = $category->products()->where('slug',$product_slug)->first();
            if($product)
            {
            return view('frontend.collections.products.view', compact('product','category'));
            }else{
                return redirect()->back();
            }
        }
        else{
            return redirect()->back();
        }

    }
    public function showBySubcategory($subcategorySlug)
    {
        // Fetch the subcategory based on the slug
        $subcategory = Subcategory::where('slug', $subcategorySlug)->firstOrFail();

        // Fetch products based on the subcategory
        $products = Product::where('subcategory_id', $subcategory->id)->get();

        // Render the products page
        return view('frontend.subcategory.show-product', ['products' => $products, 'subcategory' => $subcategory]);
    }

    public function thankyou()
    {
        return view('frontend.thank-you');
    }



}

