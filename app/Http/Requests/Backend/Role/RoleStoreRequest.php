<?php

namespace App\Http\Requests\Backend\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
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
            'title' => 'required|between:3,50|unique:roles,title',
            'description' => 'max:250',
            'associatedPermissions' => 'array',
            'associatedPermissions.*' => 'numeric|distinct|exists:permissions,id',
        ];
    }
}
