<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'description' => [
                'string',
            ],
            'price' => [
                'required',
                'numeric',
                'between:0,99999.99',
            ],
            'picture' => [
                'nullable',
                'string',
            ],
            'is_publish' => [
                'boolean',
            ],
            'categories_id' => [
                'required',
                'array',
                'min:2',
                'max:10'
            ],
            'categories_id.*' => [
                'required',
                'integer',
            ]
        ];
    }
}
