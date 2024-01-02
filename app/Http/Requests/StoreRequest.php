<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'photo' => ['required', 'image', 'max:5120', 'mimes:png,jpeg,jpg'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O Nome é obrigatório.',
            'email.required' => 'O E-mail é obrigatório.',
            'photo.required' => 'A Foto é obrigatória.',
            'name.max' => 'O Nome deve ser ter no máximo 255 caracteres.',
            'email.max' => 'O E-mail deve ser ter no máximo 255 caracteres.',
            'email.email' => 'Deve ser um E-mail válido.',
            'photo.image' => 'Deve ser uma imagem.',
            'photo.max' => 'A imagem deve ter o tamanho máximo de 5MB (Mega Bytes).',
            'photo.mimes' => 'A imagem deve ser do tipo PNG, JPEG ou JPG.',
        ];
    }
}
