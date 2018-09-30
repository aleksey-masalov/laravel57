<?php

namespace App\Http\Requests\Backend\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
        $role = $this->route('role');

        return [
            'title' => 'required|between:3,50|unique:roles,title,' . $role->id,
            'description' => 'max:250',
            'associatedPermissions' => 'array',
            'associatedPermissions.*' => 'numeric|distinct|exists:permissions,id',
        ];
    }
}
