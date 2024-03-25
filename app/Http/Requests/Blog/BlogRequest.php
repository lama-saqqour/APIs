<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        $store =  [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'category' => ['required', 'string'],
            'image' => ['required', 'file', 'nullable'],
            'state_id' => ['required', 'string'],
        ];
        $update =  [
            'title' => ['required', 'string', 'max:255'],
            'image' => ['file', 'nullable'],
            'state_id' => ['required', 'string'],
            'body' => ['required', 'string'],
        ];
        return ($this->method() === 'POST') ? $store : $update;
    }
}
