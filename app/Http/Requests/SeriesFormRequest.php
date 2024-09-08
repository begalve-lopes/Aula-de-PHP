<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'nome'=>['max:129','min:3'],
            'cover' => 'file|mimes:jpeg,png,jpg,gif', // Define regras de validação para o arquivo
        ];
    }

    public function messages(){
        return [
            'nome.required'=>'o como nome é obrigatorio utilizar caracter',
            'nome.min'=>'o campo nome é obrigatorio ter no minimo :min',
            'nome.max'=>'o campo nome é obrigatorio ter no maximo :max'
        ];
    }
}
