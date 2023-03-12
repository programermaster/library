<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'book_number' => ['required', 'string', Rule::unique('books')->ignore($this->book),'max:255'],
            'author_id' => ['required', 'exists:authors,id'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is Must',
            'description.required' => 'Description is Must',
            'book_number.required' => 'Book number is Must',
            'author_id.required' => 'Author is Must',
        ];
    }
}
