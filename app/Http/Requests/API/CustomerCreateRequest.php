<?php

namespace App\Http\Requests\API;

use A17\Twill\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CustomerCreateRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'regex:/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле обязательное для заполнения!',
            'email.regex' => 'Введен не корректный e-mail!',
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
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
