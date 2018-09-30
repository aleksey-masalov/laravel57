<?php
namespace App\Http\Requests\Backend\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
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
        $permission = $this->route('permission');

        return [
            'title' => 'required|between:3,50|unique:permissions,title,' . $permission->id,
            'description' => 'max:250',
        ];
    }
}