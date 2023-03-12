<?php

namespace App\Http\Requests\Pagination;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
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
            'page' => ['numeric', 'gt:0'],
            'rowsPerPage' => ['numeric', 'gt:0'],
            'sortBy' => ['in:id,first_name,last,country,timezone'],
            'descending' => ['in:true,false'],
            'filter' => ['nullable'],
        ];
    }
}
