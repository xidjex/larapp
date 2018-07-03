<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => 'required|integer|max:500',
            'floor' => 'required|integer|max:25',
            'entrance' => 'required|integer|max:20',
            'owners' => 'required|array',
            'kit' => 'required'
        ];
    }

    public function messages()
    {
        $required_text = 'Это поле обязательное!';
        $integer_text = 'Это поле должно быть числом!';
        $max_text = 'Слишком большое значение!';

        return [
            'number.required' => $required_text,
            'number.integer' => $integer_text,
            'number.max' => $max_text,
            'floor.required' => $required_text,
            'floor.integer' => $integer_text,
            'floor.max' => 'А не слишком ли высоко?',
            'entrance.required' => $required_text,
            'entrance.integer' => $integer_text,
            'entrance.max' => $max_text,
            'owners.required' => 'Добавте минимум одного владельца!',
            'owners.array' => 'Неверные данные!',
            'kit.required' => $required_text
        ];
    }
}
