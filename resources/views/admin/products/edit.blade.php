@extends('admin.layouts.app')

@section('title')
    Edit Product
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')

        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white">
                        <h3 class="mt-2">Edit Product</h3>
                    </div>

                    <hr>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <form action="{{ route('admin.products.update', $product->slug) }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" id="name" value="{{old('name', $product->name)}}"
                                               aria-describedby="helpId"
                                               placeholder="Name*"/>
                                        @error('name')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="qty" class="form-label">Quantity*</label>
                                        <input type="number" class="form-control @error('qty') is-invalid @enderror"
                                               name="qty" id="qty" value="{{old('qty', $product->qty)}}"
                                               aria-describedby="helpId"
                                               placeholder="Quantity*" min="0"/>
                                        @error('qty')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price*</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                               name="price" id="price" value="{{old('price', $product->price)}}"
                                               aria-describedby="helpId"
                                               placeholder="Price*" min="0"/>
                                        @error('price')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category*</label>
                                        <select class="form-control @error('category_id') is-invalid @enderror"
                                                name="category_id" id="category_id">
                                            <option value="" selected disabled>Choose a category</option>

                                            @foreach ($categories as $category)
                                                <option
                                                    value="{{ $category->id }}"
                                                    @if (old('category_id',$product->category_id) == $category->id) selected @endif
                                                >
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="brand_id" class="form-label">Brand*</label>
                                        <select class="form-control @error('brand_id') is-invalid @enderror"
                                                name="brand_id" id="brand_id">
                                            <option value="" selected disabled>Choose a brand</option>

                                            @foreach ($brands as $brand)
                                                <option
                                                    value="{{ $brand->id }}"
                                                    @if (old('brand_id',$product->brand_id) == $brand->id) selected @endif
                                                >
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="color_id" class="form-label">Colors*</label>
                                        <select
                                            id="color_id"
                                            name="color_id[]"
                                            class="form-control @error('color_id') is-invalid @enderror"
                                            multiple
                                        >
                                            @foreach ($colors as $color)
                                                <option
                                                    value="{{ $color->id }}"
                                                    @if(collect(old('color_id',$product->colors->pluck('id')))->contains($color->id)) selected @endif
                                                >
                                                    {{ $color->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('color_id')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="size_id" class="form-label">Sizes*</label>
                                        <select
                                            id="size_id"
                                            name="size_id[]"
                                            class="form-control @error('size_id') is-invalid @enderror"
                                            multiple
                                        >
                                            @foreach ($sizes as $size)
                                                <option
                                                    value="{{ $size->id }}"
                                                    @if(collect(old('size_id',$product->sizes->pluck('id')))->contains($size->id)) selected @endif
                                                >
                                                    {{ $size->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('size_id')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="desc" class="form-label">Description*</label>
                                        <textarea
                                            id="desc"
                                            name="desc"
                                            value="{{old('desc')}}"
                                            class="form-control summernote @error('desc') is-invalid @enderror"
                                            aria-describedby="helpId"
                                            placeholder="Description*"
                                        >
                                            {{ old('desc', $product->desc) }}
                                        </textarea>
                                        @error('desc')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="thumbnail" class="form-label">Thumbnail*</label>
                                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                               name="thumbnail" id="thumbnail" value="{{old('thumbnail')}}"
                                               aria-describedby="helpId"/>
                                        @error('thumbnail')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <img src="{{ asset($product->thumbnail) }}" id="thumbnail_preview"
                                             class="img-fluid rounded mb-2" width="100" height="100">
                                    </div>

                                    <div class="mb-3">
                                        <label for="first_image" class="form-label">First Image</label>
                                        <input type="file"
                                               class="form-control @error('first_image') is-invalid @enderror"
                                               name="first_image" id="first_image" value="{{old('first_image')}}"
                                               aria-describedby="helpId"/>
                                        @error('first_image')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <img
                                            src="{{ asset($product->first_image) }}"
                                            id="first_image_preview"
                                            class="@if (!$product->first_image) d-none @endif img-fluid rounded mb-2"
                                            width="100"
                                            height="100"
                                        >
                                    </div>

                                    <div class="mb-3">
                                        <label for="second_image" class="form-label">Second Image</label>
                                        <input type="file"
                                               class="form-control @error('second_image') is-invalid @enderror"
                                               name="second_image" id="second_image" value="{{old('second_image')}}"
                                               aria-describedby="helpId"/>
                                        @error('second_image')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <img
                                            src="{{ asset($product->second_image) }}"
                                            id="first_image_preview"
                                            class="@if (!$product->second_image) d-none @endif img-fluid rounded mb-2"
                                            width="100"
                                            height="100"
                                        >
                                    </div>

                                    <div class="mb-3">
                                        <label for="third_image" class="form-label">Third Image</label>
                                        <input type="file"
                                               class="form-control @error('third_image') is-invalid @enderror"
                                               name="third_image" id="third_image" value="{{old('third_image')}}"
                                               aria-describedby="helpId"/>
                                        @error('third_image')
                                        <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <img
                                            src="{{ asset($product->third_image) }}"
                                            id="first_image_preview"
                                            class="@if (!$product->third_image) d-none @endif img-fluid rounded mb-2"
                                            width="100"
                                            height="100"
                                        >
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input
                                                type="radio"
                                                name="status"
                                                id="status"
                                                value="1"
                                                class="form-check-input"
                                                @checked($product->status)
                                            />
                                            <label class="form-check-label" for="status">
                                                In Stock
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                                type="radio"
                                                name="status"
                                                id="status"
                                                value="0"
                                                class="form-check-input"
                                                @checked(!$product->status)
                                            />
                                            <label class="form-check-label" for="">
                                                Out of Stock
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-dark">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
