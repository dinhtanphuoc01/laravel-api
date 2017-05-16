<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class CategoryRequests extends FormRequest
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
            'name'      => 'required|max:20',
            'parent_id' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {

        return [
            'name.required'      => 'Bắt buộc có trường Name',
            'name.max'           => 'Tối đa 20 kí tự',
            'parent_id.required' => 'Bắt buộc có trường Parent_id',
            'parent_id.integer'  => 'Bắt buộc trường parent_id là số',
            'parent_id.min'      => 'Tối thiểu là số 0',
        ];
    }

    public function response(array $errors)
    {
        return Response::json($errors, 400);
    }
}
