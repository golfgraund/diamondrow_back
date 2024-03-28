<?php

namespace App\Http\Requests\API;

use A17\Twill\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PuzzlePutRequest extends Request
{
    public function rules(): array
    {
        return [
            'slug' => ['required'],
            'matrix_progress' => ['required'],
            'sector_index' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.required' => 'Не получен slug',
            'matrix_progress.required' => 'Матрица не получена',
            'sector_index' => 'Сектор не получен',
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
