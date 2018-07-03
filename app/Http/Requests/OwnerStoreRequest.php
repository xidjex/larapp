<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerStoreRequest extends FormRequest
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
             'number' => 'required',
             'name' => 'required|string',
             'apartment_id' => 'required|integer'
         ];
     }

     public function messages()
     {
         return [
             'number.required' => 'Нет Номера!',
             'name.required' => 'Нет имени владельца!',
             'name.string' => 'Имя должно быть строкой!',
             'apartment_id.required' => 'Нет привязаной кватриры!',
             'apartment_id.integer' => 'Поле должно быть числом!'
         ];
     }
}
