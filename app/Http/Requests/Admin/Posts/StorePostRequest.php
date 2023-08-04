<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('super.admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'transaction_id' => ['required', 'numeric'],
            'country_code' => ['required', 'min:2', 'max:199', 'string'],
            // 'status' => ['required', 'min:3', 'max:199', 'string'],
            'status' => ['required','boolean'],
        ];
    }
}
