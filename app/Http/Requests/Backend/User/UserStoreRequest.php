<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;

class UserStoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:3,250',
            'email' => 'required|email|max:250|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'isActive' => 'in:1',
            'isConfirmed' => 'in:1',
            'associatedRole' => 'required|numeric|exists:roles,id',
        ];
    }
}
