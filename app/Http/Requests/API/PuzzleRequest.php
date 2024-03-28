<?php

namespace App\Http\Requests\API;

use A17\Twill\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PuzzleRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'regex:/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i'],
            'code' => ['required', 'min:11', 'regex:/^[A-Z0-9]{3}-[A-Z0-9]{3}-[A-Z0-9]{3}$/'],
            'preview_picture' => ['file', 'required', 'max:5000', 'mimes:png,jpg'],
            'picture_colors' => ['required'],
            'preview_picture_type' => ['required'],
            'matrix_progress' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Не введен код',
            'code.min' => 'Введен неверный код',
            'code.regex' => 'Введен неверный код',
            'preview_picture.file' => 'Отсутствует изображение',
            'email.required' => 'Поле обязательное для заполнения',
            'email.regex' => 'Введен неверный e-mail',
            'preview_picture.max' => 'Слишком большой размер файла, макс: 10мб',
            'preview_picture.mimes' => 'Неверный формат файла',
            'preview_picture.required' => 'Поле обязательное для заполнения',
            'picture_colors.required' => 'Поле обязательное для заполнения',
            'matrix_progress.required' => 'Поле обязательное для заполнения',
            'preview_picture_type.required' => 'Поле обязательное для заполнения',
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
