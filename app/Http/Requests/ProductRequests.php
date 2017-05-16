<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class ProductRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:30',
            'image'         => 'required|max:255',
            'price'         => 'required|integer|min:0',
            'categories_id' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required'          => 'Bắt buộc có trường Name',
            'name.max'               => 'Tối đa 30 kí tự',
            'image.required'         => 'Bắt buộc có trường Image',
            'image.max'              => 'Tối đa 255 kí tự',
            'price.required'         => 'Bắt buộc có trường Price',
            'price.integer'          => 'Bắt buộc trường Price là số',
            'price.min'              => 'Tối thiểu Price là 0',
            'categories_id.required' => 'Bắt buộc có trường Category_id',
            'categories_id.integer'  => 'Bắt buộc trường Category_id là số',
            'categories_id.min'      => 'Tối thiểu Category_id là 0',
        ];
    }

    public function response(array $errors)
    {
        return Response::json($errors, 400);
    }
}
