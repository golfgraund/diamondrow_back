<?php

namespace App\Http\Requests\Admin;

use A17\Twill\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CustomerRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'regex:/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i'],
            'code' => ['min:11', 'regex:/^[A-Z0-9]{3}-[A-Z0-9]{3}-[A-Z0-9]{3}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.regex' => 'Введен неверный код',
            'code.min' => 'Введен неверный код',
            'email.regex' => 'Введен неверный e-mail',
            'email.required' => 'Поле обязательное для заполнения',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator): void
    {
        $message = $validator->errors();

        throw (new ValidationException($validator, response(['status' => 'error', 'response' => $message], 422)))
            ->errorBag($this->errorBag);
    }
}
