<?php

namespace App\ReferenceBook\Infrastructure\Requests;

use App\ReferenceBook\Application\DTOs\OrganizationNameDTO;
use Illuminate\Support\Facades\Auth;

class OrganizationNameRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:100|exists:organizations,name',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Поле name обязательно.',
            'name.min' => 'Поле name должно содержать минимум 3 символа.',
            'name.max' => 'Поле name  должно содержать максимум 100 символов.',
            'name.exists' => 'Указанное name не существует в системе.',
        ];
    }

    public function getDTO(): OrganizationNameDTO
    {
        return OrganizationNameDTO::fromArray($this->validated());
    }

}
