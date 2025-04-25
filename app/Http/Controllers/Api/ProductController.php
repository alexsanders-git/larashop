<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /** Get all products */
    public function index()
    {
        return ProductResource::collection(
            Product::with(['category', 'colors', 'sizes', 'brand'])->latest()->get()
        )->additional([
                    'categories' => Category::has('products')->get(),
                    'colors' => Color::has('products')->get(),
                    'sizes' => Size::has('products')->get(),
                    'brand' => Brand::has('products')->get(),
                ]);
    }

    /** Get product by slug */
    public function show(Product $product)
    {
        if (! $product) {
            abort(404);
        }

        return ProductResource::collection(
            $product->load(['category', 'colors', 'sizes', 'brand', 'reviews'])
        );
    }

    /** Filter products by category */
    public function filterProductsByCategory(Category $category)
    {
        return ProductResource::collection(
            $category->products()->with(['category', 'colors', 'sizes', 'brand'])->latest()->get()
        )->additional([
                    'categories' => Category::has('products')->get(),
                    'colors' => Color::has('products')->get(),
                    'sizes' => Size::has('products')->get(),
                    'brand' => Brand::has('products')->get(),
                    'filter' => $category->name,
                ]);
    }

    /** Filter products by brand */
    public function filterProductsByBrand(Brand $brand)
    {
        return ProductResource::collection(
            $brand->products()->with(['category', 'colors', 'sizes', 'brand'])->latest()->get()
        )->additional([
                    'categories' => Category::has('products')->get(),
                    'colors' => Color::has('products')->get(),
                    'sizes' => Size::has('products')->get(),
                    'brand' => Brand::has('products')->get(),
                    'filter' => $brand->name,
                ]);
    }

    /** Filter products by color */
    public function filterProductsByColor(Color $color)
    {
        return ProductResource::collection(
            $color->products()->with(['category', 'colors', 'sizes', 'brand'])->latest()->get()
        )->additional([
                    'categories' => Category::has('products')->get(),
                    'colors' => Color::has('products')->get(),
                    'sizes' => Size::has('products')->get(),
                    'brand' => Brand::has('products')->get(),
                    'filter' => $color->name,
                ]);
    }

    /** Filter products by size */
    public function filterProductsBySize(Size $size)
    {
        return ProductResource::collection(
            $size->products()->with(['category', 'colors', 'sizes', 'brand'])->latest()->get()
        )->additional([
                    'categories' => Category::has('products')->get(),
                    'colors' => Color::has('products')->get(),
                    'sizes' => Size::has('products')->get(),
                    'brand' => Brand::has('products')->get(),
                    'filter' => $size->name,
                ]);
    }

    /** Find products by term */
    public function findProductsByTerm($searchTerm)
    {
        return ProductResource::collection(
            Product::where('name', 'LIKE', '%'.$searchTerm.'%')->with(['category', 'colors', 'sizes', 'brand'])->latest()->get()
        )->additional([
                    'categories' => Category::has('products')->get(),
                    'colors' => Color::has('products')->get(),
                    'sizes' => Size::has('products')->get(),
                    'brand' => Brand::has('products')->get(),
                ]);
    }
}
