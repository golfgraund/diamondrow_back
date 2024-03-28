<?php

namespace App\Http\Requests\API;

use A17\Twill\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CustomerVerifyRequest extends Request
{
    public function rules(): array
    {
        return [
            'mail_code' => ['required', 'min:4', 'max:4'],
        ];
    }

    public function messages(): array
    {
        return [
            'mail_code.required' => 'Не получен код',
            'mail_code.min' => 'Введен неверный код',
            'mail_code.max' => 'Введен неверный код',
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
