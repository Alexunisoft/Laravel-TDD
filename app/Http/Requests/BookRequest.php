<?php

namespace App\Http\Requests;

use App\Rules\Isbn;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required",
            "description" => ["required", "min:20"],
            "author_id" => "exists:authors,id",
            "ISBN" => [new Isbn()]
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "title is required",
            "description.required" => "description is required",
            "description.min" => "description length minimum is 20",
            "author_id.exists" => "Author must be valid"
        ];
    }
}
