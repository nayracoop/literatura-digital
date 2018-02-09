<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class EditUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //unique:table, field, except, except_field
        //le paso el user (_id) del request para permitir el update cuando el valor coincide con sí mismo
        return [
            'username' => 'required|max:255|unique:users,username,' .
                (($this->user) ? $this->user : 'NULL') . ',_id',
            'email' => 'required|email|max:255|unique:users,email,' .
                (($this->user) ? $this->user : 'NULL') . ',_id',
            'password' => 'required|min:6',
        ];
    }
}
