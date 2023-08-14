<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeStoreFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:people,email',
            'password' => 'required|string|min:6|confirmed',
            'birthdate' => 'required|date_format:Y-m-d',
            'neighborhood' => 'required|string',
            'street' => 'required|string',
            'zip_code' => 'required|integer',
            'number' => 'required|integer',
            'country' => 'required|integer',
            'ddd' => 'required|integer',
            'phone_number' => 'required|string|unique:phone_numbers,number|min:8|max:8',
            'work_time' => 'string'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nome',
            'password' => 'senha',
            'birthdate' => 'data de aniversario',
            'neighborhood' => 'bairro',
            'street' => 'rua',
            'zip_code' => 'cep',
            'number' => 'número',
            'country' => 'país',
            'phone_number' => 'número de telefone',
            'work_time' => 'Horário de trabalho'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'email' => 'O campo :attribute precisa ser um email válido',
            'exists' => 'O campo :attribute ainda não foi registrado no sistema',
            'string' => 'O campo :attribute precisa ser um texto valido',
            'min' => 'O campo :attribute precisa ter pelo menos :min caracteres',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres',
            'confirmed' => 'As senhas inseridas não estão idênticas',
            'unique' => 'O campo :attribute já está em uso',
            'date_format' => 'O campo :attribute precisa estar no formato :format',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'errors' => $validator->errors(),
            'message' => 'Authentication failed'
        ], 422);

        throw new HttpResponseException($response);
    }
}
