<?php

namespace App\Models\Traits\Permission;

use App\Models\Permission;

trait PermissionAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            $this->getShowButtonAttribute() .
            $this->getEditButtonAttribute();
    }

    /**
     * @return string
     */
    private function getShowButtonAttribute()
    {
        return auth()->check() && auth()->user()->hasPermission(Permission::PERMISSION_KEY_PERMISSION_VIEW)
            ? '<a href="' . route('backend.permissions.show', $this) . '" class="btn btn-info btn-sm" role="button"><i class="fa fa-search"></i> ' . trans('buttons.general.crud.show') . '</a> '
            : '';
    }

    /**
     * @return string
     */
    private function getEditButtonAttribute()
    {
        return auth()->check() && auth()->user()->hasPermission(Permission::PERMISSION_KEY_PERMISSION_UPDATE)
            ? '<a href="' . route('backend.permissions.edit', $this) . '" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i> ' . trans('buttons.general.crud.edit') . '</a> '
            : '';
    }
}