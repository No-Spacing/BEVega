<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;
use App\Models\Role;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(User $user): bool
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
            'name' => [ 'required' ],
            'category' => [ 'required' ],
            'description' => [ 'required' ],
            'image' => [ 'required', 'array' ],            
            'image.*' => [ 'image' ],
            'date' => ['required']
        ];
    }
}
