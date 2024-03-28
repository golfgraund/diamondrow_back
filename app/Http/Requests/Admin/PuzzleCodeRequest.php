<?php

namespace App\Http\Requests\Admin;

use A17\Twill\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PuzzleCodeRequest extends Request
{
    public function rules(): array
    {
        return [
            'code' => ['min:11', 'regex:/^[A-Z0-9]{3}-[A-Z0-9]{3}-[A-Z0-9]{3}$/'],
            'count' => ['numeric' , 'min:0' , 'not_in:0', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.regex' => 'Введен неверный код',
            'code.min' => 'Введен неверный код',
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
