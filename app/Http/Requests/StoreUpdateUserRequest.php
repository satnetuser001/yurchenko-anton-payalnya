<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|min:10|max:255',
            'status' => 'required|in:Потенційний,Активний,Неактивний,Втрачений',
            'city' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Це поле обов\'язкове.',
            '*.max' => 'Максимальна довжина цього поля - 255 символів.',
            'email.email' => 'Введіть коректну електронну адресу.',
            'email.unique' => 'Користувач з такою електронною поштою вже існує.',
            'phone_number.min' => 'Номер телефону повинен містити щонайменше 10 цифр.',
            'status.in' => 'Оберіть один із запропонованих статусів.',
        ];
    }
}
