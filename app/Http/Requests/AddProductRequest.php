<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:products',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'color_id' => 'required',
            'size_id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'desc' => 'required|max:5000',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'first_image' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'second_image' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'third_image' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'qty.required' => 'The quantity is required',
            'color_id.required' => 'The color is required',
            'size_id.required' => 'The size is required',
            'category_id.required' => 'The category is required',
            'brand_id.required' => 'The brand is required',
            'desc.required' => 'The description is required',
            'desc.max' => 'The description must not be greater than :max characters',
            'thumbnail.image' => 'The thumbnail must be an image',
            'thumbnail.max' => 'The thumbnail must not be greater than 2MB',
            'first_image.image' => 'The first image must be an image',
            'first_image.max' => 'The first image must not be greater than 2MB',
            'second_image.image' => 'The second image must be an image',
            'second_image.max' => 'The second image must not be greater than 2MB',
            'third_image.image' => 'The third image must be an image',
            'third_image.max' => 'The third image must not be greater than 2MB',
        ];
    }
}
