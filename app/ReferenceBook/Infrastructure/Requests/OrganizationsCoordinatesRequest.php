<?php

namespace App\ReferenceBook\Infrastructure\Requests;

use App\ReferenceBook\Application\DTOs\OrganizationsCoordinatesDTO;

class OrganizationsCoordinatesRequest extends ApiRequest
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
            'lng' => 'required|numeric:10|min:-180|max:180',
            'lat' => 'required|numeric:10|min:-90|max:90',
            'radius' => 'required|integer|between:1,10000000',
        ];
    }

    public function messages(): array
    {
        return [
            'lng.required' => 'Поле lng обязательно.',
            'lng.numeric' => 'Поле lng должно быть числом.',
            'lng.min' => 'Поле lng должно быть не меньше -180',
            'lng.max' => 'Поле lng должно быть не больше 180.',
            'lat.required' => 'Поле lng обязательно.',
            'lat.numeric' => 'Поле lat должно быть числом.',
            'lat.min' => 'Поле lat должно быть не меньше -90',
            'lat.max' => 'Поле lat должно быть не больше 90.',
            'radius.required' => 'Поле radius обязательно.',
            'radius.integer' => 'Поле radius должно быть числом.',
            'radius.between' => 'Поле radius должно быть в диапазоне от 1 до 10000000.',
        ];
    }

    public function getDTO(): OrganizationsCoordinatesDTO
    {
        return OrganizationsCoordinatesDTO::fromArray($this->validated());
    }

}
