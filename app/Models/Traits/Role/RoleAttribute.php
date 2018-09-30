<?php

namespace App\Models\Traits\Role;

use App\Models\Permission;

trait RoleAttribute
{
    /**
     * @return string
     */
    public function getPermissionsLabelAttribute()
    {
        if (!$this->permissions->count()) {
            return '<span class="badge badge-danger">' . trans('labels.general.none') . '</span>';
        }

        $permissions = $this->permissions->pluck('title')->toArray();

        $permissionsLabel = [];

        foreach ($permissions as $permission) {
            $permissionsLabel[] = '<span class="badge badge-info">' . $permission . '</span>';
        }

        return implode(' ', $permissionsLabel);
    }

    /**
     * @return string
     */
    public function getRoleKeyLabelAttribute()
    {
        return '<span class="badge badge-secondary">' . $this->key . '</span>';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            $this->getShowButtonAttribute() .
            $this->getEditButtonAttribute() .
            $this->getDeleteButtonAttribute();
    }

    /**
     * @return string
     */
    private function getShowButtonAttribute()
    {
        return auth()->check() && auth()->user()->hasPermission(Permission::PERMISSION_KEY_ROLE_VIEW)
            ? '<a href="' . route('backend.roles.show', $this) . '" class="btn btn-info btn-sm" role="button"><i class="fa fa-search"></i> ' . trans('buttons.general.crud.show') . '</a> '
            : '';
    }

    /**
     * @return string
     */
    private function getEditButtonAttribute()
    {
        return auth()->check() && auth()->user()->hasPermission(Permission::PERMISSION_KEY_ROLE_UPDATE)
            ? '<a href="' . route('backend.roles.edit', $this) . '" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i> ' . trans('buttons.general.crud.edit') . '</a> '
            : '';
    }

    /**
     * @return string
     */
    private function getDeleteButtonAttribute()
    {
        if ($this->isSuperAdmin()) {
            return '';
        }

        if(!auth()->check() && !auth()->user()->hasPermission(Permission::PERMISSION_KEY_ROLE_DELETE)){
            return '';
        }

        return '<a href="' . route('backend.roles.destroy', $this->id) . '"
            data-method="delete"
            data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
            data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
            data-trans-title="' . trans('alerts.general.are_you_sure') . '"
            class="btn btn-danger btn-sm" role="button"><i class="fa fa-trash"></i> ' . trans('buttons.general.crud.delete') . '</a> ';
    }
}