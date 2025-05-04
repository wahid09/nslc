<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('product-index');
        //$products = Product::with('area')->get();
        $products = Product::getProduct();
        return view('backend.product.index', ['products' => $products,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('product-create');
        $categories = Category::active()->get();
        $areas = Area::getArea();
        return view('backend.product.form', compact('categories', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('product-create');
        $this->validate($request, [
            'title_bn' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
            'price'=>'required',
        ]);

        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('products/')) {
                Storage::disk('public')->makeDirectory('products/');
            }
            $makImage = Image::make($image)->resize(368, 349)->stream();
            Storage::disk('public')->put('products/' . $imageName, $makImage);
        } else {
            $imageName = "";
        }
        $products = Product::create([
            'title_bn' => $request->title_bn,
            'categorie_id' => $request->category,
            'area_id' => $request->area,
            'image' => $imageName,
            'price'=> $request->price,
            'discount'=> $request->discount,
            'status' => $request->filled('status')
        ]);
        notify()->success('Product Added', 'Success');
        return redirect()->route('app.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        Gate::authorize('product-update');
        $categories = Category::active()->get();
        $areas = Area::active()->get();
        return view('backend.product.form', compact('product', 'categories', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        Gate::authorize('product-update');
        Gate::authorize('product-create');
        $this->validate($request, [
            'title_bn' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
            'price'=>'required'
        ]);

        $image = $request->file('image');
        $name = Str::slug($request->input('title_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('products/')) {
                Storage::disk('public')->makeDirectory('products/');
            }
            $makImage = Image::make($image)->resize(368, 349)->stream();
            Storage::disk('public')->put('products/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('products/' . $product->image)) {
                Storage::disk('public')->delete('products/' . $product->image);
            }
        }

        if (empty($imageName) && !empty($product->image)) {
            $imageName = $product->image;
        }
        $product->update([
            'title_bn' => $request->title_bn,
            'categorie_id' => $request->category,
            'area_id' => $request->area,
            'image' => $imageName,
            'price'=> $request->price,
            'discount'=> $request->discount,
            'status' => $request->filled('status')
        ]);
        notify()->success('Product Update', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Gate::authorize('product-delete');
        if (Storage::disk('public')->exists('products/' . $product->image)) {
            Storage::disk('public')->delete('products/' . $product->image);
        }
        $product->delete();
        notify()->success("Product Deleted", "Success");
        return back();
    }
}
