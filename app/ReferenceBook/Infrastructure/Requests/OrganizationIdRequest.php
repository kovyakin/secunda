<?php

namespace App\ReferenceBook\Infrastructure\Requests;

use App\ReferenceBook\Application\DTOs\OrganizationIdDTO;

class OrganizationIdRequest extends ApiRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:organizations,id',
        ];
    }
    public function messages(): array
    {
        return [
            'id.required' => 'Поле id обязательно.',
            'id.integer' => 'Поле id должно быть целым числом.',
            'id.exists' => 'Организации с таким id не найдено.',
        ];
    }

    public function getDTO(): OrganizationIdDTO
    {
        return OrganizationIdDTO::fromArray($this->validated());
    }

}
