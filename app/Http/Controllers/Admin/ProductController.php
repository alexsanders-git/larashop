<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.index')
            ->with([
                'products' => Product::with(['category', 'colors', 'sizes', 'brand'])->latest()->get()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $brands = Brand::all();

        return view('admin.products.create')
            ->with([
                'categories' => $categories,
                'colors' => $colors,
                'sizes' => $sizes,
                'brands' => $brands,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        if ($request->validated()) {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->name);
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));

            if ($request->has('first_image')) {
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }

            if ($request->has('second_image')) {
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }

            if ($request->has('third_image')) {
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }

            $product = Product::create($data);

            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);

            return redirect()->route('admin.products.index')
                ->with('success', 'Product has been added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $brands = Brand::all();

        return view('admin.products.edit')
            ->with([
                'categories' => $categories,
                'colors' => $colors,
                'sizes' => $sizes,
                'brands' => $brands,
                'product' => $product,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->validated()) {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->name);
            $data['status'] = $request->status;

            if ($request->has('thumbnail')) {
                $this->removeProductImageFromStorage($product->thumbnail);
                $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            }

            if ($request->has('first_image')) {
                $this->removeProductImageFromStorage($product->first_image);
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }

            if ($request->has('second_image')) {
                $this->removeProductImageFromStorage($product->second_image);
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }

            if ($request->has('third_image')) {
                $this->removeProductImageFromStorage($product->third_image);
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }

            $product->update($data);

            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);

            return redirect()->route('admin.products.index')
                ->with('success', 'Product has been updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->removeProductImageFromStorage($product->thumbnail);
        $this->removeProductImageFromStorage($product->first_image);
        $this->removeProductImageFromStorage($product->second_image);
        $this->removeProductImageFromStorage($product->third_image);

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product has been deleted successfully');
    }

    /**
     * Upload and save product images
     */
    public function saveImage($file)
    {
        $image_name = time().'_'.$file->getClientOriginalName();
        $file->storeAs('images/products', $image_name, 'public');
        return 'storage/images/products/'.$image_name;
    }

    /**
     * Remove old image from storage
     */
    public function removeProductImageFromStorage($file)
    {
        $path = public_path($file);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
