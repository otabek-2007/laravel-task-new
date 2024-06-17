<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules()
    {
        $actionMethod = $this->route()->getActionMethod();
        $rules = [];
        if ($actionMethod == "store") {
            $rules = $this->StoreRules();
        } else if ($actionMethod == 'login') {
            $rules = $this->loginRules();
        } else if ($actionMethod == 'edit') {
            $rules = $this->editRules();
        }
        return $rules;
    }
    public function loginRules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }
    public function storeRules(): array
    {
        return [
            'name' => ['required', 'max:50', 'min:2'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'max:255', 'min:8'],
        ];
    }
    public function editRules(): array
    {
        return [
            'name' => ['nullable', 'max:50', 'min:2'],
            'email' => ['nullable', 'email', 'max:255'],
            'password' => ['nullable', 'max:255', 'min:8'],
        ];
    }
}
