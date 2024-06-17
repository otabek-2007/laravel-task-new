<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $actionMethod = $this->route()->getActionMethod();
        $rules = [];
        if ($actionMethod === 'storePost') {
            $rules = $this->storePost();
        } else if ($actionMethod === 'updatePost') {
            $rules = $this->updatePost();
        } else if ($actionMethod === 'storeCategory') {
            $rules = $this->storeCategory();
        } else if ($actionMethod === 'updateCategory') {
            $rules = $this->updateCategory();
        }

        return $rules;
    }

    public function storePost(): array
    {
        return [
            'category_id' => ['required', 'numeric', 'exists:new_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'text_ru' => ['required', 'string'],
            'text_uz' => ['required', 'string'],
            'thumbnail' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime', 'max:20480'],
        ];

    }
    public function updatePost(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'thumbnail' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime', 'max:20480'],
        ];

    }

    public function storeCategory(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'about' => ['required', 'string'],
            'image' => ['nullable', 'image'],
        ];
    }
    public function updateCategory(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'about' => ['required', 'string'],
            'image' => ['nullable', 'image'],
        ];
    }


}
