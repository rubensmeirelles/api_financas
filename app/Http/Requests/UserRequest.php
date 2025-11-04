<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'perfil' => 'required|string',
        ];

        // Se for método POST → criando novo usuário
        if ($this->$request->method('post')) {
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|string|min:6';
        }

        // Se for método PUT ou PATCH → atualizando usuário
        if ($this->$request->method('put') || $this->$request->method('patch')) {
            $userId = $this->route('id'); // obtém o ID da rota

            $rules['email'] = 'sometimes|email|unique:users,email,' . $userId;
            $rules['password'] = 'sometimes|string|min:6';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do usuário é obrigatório.',
            'id.integer' => 'O ID deve ser um número inteiro.',
            'id.exists' => 'Usuário não encontrado no sistema.',
        ];
    }
}
