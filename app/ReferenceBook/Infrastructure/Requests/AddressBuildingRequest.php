<?php

namespace App\ReferenceBook\Infrastructure\Requests;

use App\ReferenceBook\Application\DTOs\AddressBuildingDTO;

class AddressBuildingRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
//    public string $country;
//    public string $city;
//    public string $street;
//    public string $house;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country' => 'required|string|min:3|max:100|exists:buildings,country',
            'city' => 'required|string|min:3|max:100|exists:buildings,city',
            'street' => 'required|string|min:3|max:100|exists:buildings,street',
            'house' => 'required|string|min:1|max:4|exists:buildings,house',
        ];
    }
    public function attributes(): array
    {
        return [
            'country' => 'страна',
            'city' => 'город',
            'street' => 'улица',
            'house' => 'дом',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Поле :attribute обязательно для заполнения.',
            '*.string' => 'Поле :attribute должно быть строкой.',
            '*.min' => 'Поле :attribute должно содержать минимум :min символа.',
            '*.max' => 'Поле :attribute должно содержать максимум :max символов.',
            '*.exists' => 'Указанный :attribute не существует в системе.',
        ];
    }

    public function getDTO(): AddressBuildingDTO
    {
        return AddressBuildingDTO::fromArray($this->validated());
    }

}
