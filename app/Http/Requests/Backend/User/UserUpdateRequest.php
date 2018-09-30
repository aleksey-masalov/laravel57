<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;

class UserUpdateRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'name' => 'required|between:3,250',
            'email' => 'required|email|max:250|unique:users,email,' . $user->id,
            'isActive' => 'in:1',
            'isConfirmed' => 'in:1',
            'associatedRole' => 'required|numeric|exists:roles,id',
        ];
    }
}
